(function(){
  
  Renderer = function(canvas, path){

    var dom = $(canvas)
    var canvas = dom.get(0)
    var ctx = canvas.getContext("2d")
    var gfx = arbor.Graphics(canvas)
    var particleSystem = null
    var imagepath = path

    var selected = null,
        nearest = null,
        _mouseP = null;
         
    // Main output section
    var that = {
      init:function(system){
        particleSystem = system
        particleSystem.screenSize(canvas.width, canvas.height)
        particleSystem.screenPadding(40, 40,40,40)

        that.initMouseHandling()

        // Preload all images into the node object
        particleSystem.eachNode(function(node, pt) {
          if(node.data.image) {  
         // alert(imagepath + node.data.image);
            node.data.imageob = new Image()
            node.data.imageob.src = imagepath + node.data.image
          }
        } )
      },

      redraw:function(){
        if (!particleSystem) return
        gfx.clear() // convenience ƒ: clears the whole canvas rect
        // draw the nodes & save their bounds for edge drawing
        var nodeBoxes = {}
        
        // draw the edges
        particleSystem.eachEdge(function(edge, pt1, pt2){
          // edge: {source:Node, target:Node, length:#, data:{}}
          // pt1:  {x:#, y:#}  source position in screen coords
          // pt2:  {x:#, y:#}  target position in screen coords
         
          // Don't draw lines that shouldn't be there
          if (edge.source.data.alpha * edge.target.data.alpha == 0) return
          gfx.line(pt1, pt2, {stroke:'#F8BF43', width:2, alpha:edge.target.data.alpha})
        })
        
        // draw the nodes
        particleSystem.eachNode(function(node, pt){
          // node: {mass:#, p:{x,y}, name:"", data:{}}
          // pt:   {x:#, y:#}  node position in screen coords
          
          // Hide hidden nodes
          if (node.data.alpha===0) return
          
          // Load extra info
          var imageob = node.data.imageob
          var imageH = node.data.image_h
          var imageW = node.data.image_w
          var radius = parseInt(node.data.radius)
          // determine the box size and round off the coords if we'll be 
          // drawing a text label (awful alignment jitter otherwise...)
          var label = node.data.label||""
          var w = ctx.measureText(""+label).width + 10
          if(w < radius) {
            w = radius;
          }
          if (!(""+label).match(/^[ \t]*$/)){
            pt.x = Math.floor(pt.x)
            pt.y = Math.floor(pt.y)
          }else{
            label = null
          }

          // Set colour
          if (node.data.color) ctx.fillStyle = node.data.color
          else ctx.fillStyle = "rgba(0,0,0,.2)"
          if (node.data.color=='none') ctx.fillStyle = "white"
          
          // Draw the object        
          if (node.data.shape=='dot'){
            // Check if it's a dot
          /*  gfx.oval(pt.x-w/2, pt.y-w/2, w,w, {fill:ctx.fillStyle, alpha:node.data.alpha})
            nodeBoxes[node.name] = [pt.x-w/2, pt.y-w/2, w,w] */
            // Does it have an image?      
            if (imageob){
              // Images are cached 
              ctx.drawImage(imageob, pt.x-(imageW/2), pt.y+radius/2, imageW, imageH)
            }
          }else {
            // If none of the above, draw a rectangle
           /* gfx.rect(pt.x-w/2, pt.y-10, w,20, 4, {fill:ctx.fillStyle, alpha:node.data.alpha})
            nodeBoxes[node.name] = [pt.x-w/2, pt.y-11, w, 22]
            */
            if (imageob){
              // Images are cached 
              ctx.drawImage(imageob, pt.x-(imageW/2), pt.y+radius/2, imageW, imageH)
            }
          }

          // Draw the text
          if (label){
            ctx.font = "10px Helvetica"
            ctx.textAlign = "center"
            ctx.fillStyle = "green"
            if (node.data.color=='none') ctx.fillStyle = '#333333'
            ctx.fillText(label||"", pt.x, pt.y)
            // ctx.fillText(label||"", pt.x, pt.y+4)
          }
          
        })    			

	/*particleSystem.eachEdge(function(edge, pt1, pt2){
if (edge.source.data.alpha * edge.target.data.alpha == 0) return
      gfx.line(pt1, pt2, {stroke:"#151B8D", width:(edge.data.weight/2), alpha:edge.target.data.alpha})

       })*/


      },
      switchMode:function(e){
        if (e.mode=='hidden'){
          dom.stop(true).fadeTo(e.dt,0, function(){
            if (sys) sys.stop()
            $(this).hide()
          })
        }else if (e.mode=='visible'){
          dom.stop(true).css('opacity',0).show().fadeTo(e.dt,1,function(){
            that.resize()
          })
          if (sys) sys.start()
        }
      },
      
      switchSection:function(newSection){
        var parent = sys.getEdgesFrom(newSection)[0].source
        var children = $.map(sys.getEdgesFrom(newSection), function(edge){
          return edge.target
        })
        
        sys.eachNode(function(node){
          if (node.data.shape=='dot') return // skip all but leafnodes
          var nowVisible = ($.inArray(node, children)>=0)
          var newAlpha = (nowVisible) ? 1 : 0
          var dt = (nowVisible) ? .5 : .5
          sys.tweenNode(node, dt, {alpha:newAlpha})
          if (newAlpha==1){
            node.p.x = parent.p.x + 3*Math.random() - .025
            node.p.y = parent.p.y + 3*Math.random() - .025
            node.tempMass = .001
          }
        })
      },
      
      initMouseHandling:function(){
	// no-nonsense drag and drop (thanks springy.js)
	selected = null;
	nearest = null;
	var dragged = null;
	var move = false;

	// set up a handler object that will initially listen for mousedowns then
	// for moves and mouseups while dragging
	var handler = {
	  moved:function(e){
	    var pos = $(canvas).offset();
	    _mouseP = arbor.Point(e.pageX-pos.left, e.pageY-pos.top);
	    nearest = particleSystem.nearest(_mouseP);

	    if(!nearest.node){
		return false;
	    }

	    selected = (nearest.distance < nearest.node.data.radius) ? nearest : null

	    // code for node that mouse is hovered on ('selected')
	    
	  },
	  down:function(e){
	    var pos = $(canvas).offset();
	    _mouseP = arbor.Point(e.pageX-pos.left, e.pageY-pos.top)
	    nearest = dragged = particleSystem.nearest(_mouseP);
	    move = false;

	    if (dragged && dragged.node !== null){
		dragged.node.fixed = true

	
	    }

	    $(canvas).bind('mousemove', handler.dragged)
	    $(window).bind('mouseup', handler.dropped)

	    return false
	  },
	  dragged:function(e){
	    var old_nearest = nearest && nearest.node._id
	    var pos = $(canvas).offset();
	    var s = arbor.Point(e.pageX-pos.left, e.pageY-pos.top)
	    move = true;

	    if (!nearest) return
	    if (dragged !== null && dragged.node !== null){
	      var p = particleSystem.fromScreen(s)
	      dragged.node.p = p
	    }

	    return false
	  },

	  dropped:function(e){
	   // var edit = $("#edit").prop('checked')
	    if (dragged===null || dragged.node===undefined) return
	    if (dragged.node !== null) {
		if(move===false) {
		
		NodeStory(selected.node.data.nodeid)
		//TimeLine(selected.node.data.nodeid)
		    // code for clicked node (dragged.node)

		}
		dragged.node.fixed = false
	    }
	    dragged.node.tempMass = 1000
	    dragged = null
	    selected = null
	    $(canvas).unbind('mousemove', handler.dragged)
	    $(window).unbind('mouseup', handler.dropped)
	    _mouseP = null
	    return false
	  }
	}

	$(canvas).mousedown(handler.down);
	$(canvas).mousemove(handler.moved);
	}
    }

    // helpers for figuring out where to draw arrows (thanks springy.js)
    var intersect_line_line = function(p1, p2, p3, p4)
    {
      var denom = ((p4.y - p3.y)*(p2.x - p1.x) - (p4.x - p3.x)*(p2.y - p1.y));
      if (denom === 0) return false // lines are parallel
      var ua = ((p4.x - p3.x)*(p1.y - p3.y) - (p4.y - p3.y)*(p1.x - p3.x)) / denom;
      var ub = ((p2.x - p1.x)*(p1.y - p3.y) - (p2.y - p1.y)*(p1.x - p3.x)) / denom;

      if (ua < 0 || ua > 1 || ub < 0 || ub > 1)  return false
      return arbor.Point(p1.x + ua * (p2.x - p1.x), p1.y + ua * (p2.y - p1.y));
    }

    var intersect_line_box = function(p1, p2, boxTuple)
    {
      var p3 = {x:boxTuple[0], y:boxTuple[1]},
          w = boxTuple[2],
          h = boxTuple[3]

      var tl = {x: p3.x, y: p3.y};
      var tr = {x: p3.x + w, y: p3.y};
      var bl = {x: p3.x, y: p3.y + h};
      var br = {x: p3.x + w, y: p3.y + h};

      return intersect_line_line(p1, p2, tl, tr) ||
            intersect_line_line(p1, p2, tr, br) ||
            intersect_line_line(p1, p2, br, bl) ||
            intersect_line_line(p1, p2, bl, tl) ||
            false
    }

    return that
  }    
})()
