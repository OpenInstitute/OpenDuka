//(function(){
  
 var Renderer = function(elt, hN,path){
    var dom = $(elt)
   // alert(hN);
    var canvas = dom.get(0)
    var ctx = canvas.getContext("2d");
    var gfx = arbor.Graphics(canvas)
    var sys = null
    var imagepath = path
    var hNodes = String(hN).split(",");
  //alert(hNodes[1]):
    var _vignette = null
    var selected = null,
        nearest = null,
        _mouseP = null;

    
    var that = {
      init:function(pSystem){
        sys = pSystem
        wid = .75* (document.body.clientWidth||window.innerWidth); 
        hait = .75* (document.body.clientHeight||window.innerHeight); 
        //sys.screen({size:{width:dom.width(), height:dom.height()},padding:[36,60,36,60]})
	//sys.screen({size:{wid, hait}, padding:[5,5,5,5]})
      //alert (hait);
      //  sys.screenSize(canvas.width, canvas.height)
        sys.screenSize(wid,hait)
      	sys.screenPadding(36,60,36,60)
        $(window).resize(that.resize)
        that.resize()
        that._initMouseHandling()
	// Preload all images into the node object
        sys.eachNode(function(node, pt) {
          if(node.data.image) {  
         // alert(imagepath + node.data.image);
            node.data.imageob = new Image()
            node.data.imageob.src = imagepath + node.data.image
          }
        } )
       // if (document.referrer.match(/echolalia|atlas|halfviz/)){
          // if we got here by hitting the back button in one of the demos, 
          // start with the demos section pre-selected
       //   that.switchSection('demos')
       // }
      },
      resize:function(){
        canvas.width = .95*(document.body.clientWidth||window.innerWidth);//$(window).width()
       // alert(canvas.width);
        canvas.height = .6* (document.body.clientHeight||window.innerHeight);//.75* $(window).height()
        sys.screen({size:{width:canvas.width, height:canvas.height}})
        _vignette = null
        that.redraw()
      },
      redraw:function(){
        gfx.clear()
        sys.eachEdge(function(edge, p1, p2){
          if (edge.source.data.alpha * edge.target.data.alpha == 0) return
          gfx.line(p1, p2, {stroke:"#b2b19d", width:2, alpha:edge.target.data.alpha})
        })
        sys.eachNode(function(node, pt){
          var w = Math.max(10, 5+gfx.textWidth(node.name) )
          if (node.data.alpha===0) return
          /*if (node.data.shape=='dot'){
            gfx.oval(pt.x-w/2, pt.y-w/2, w, w, {fill:node.data.color, alpha:node.data.alpha})
            gfx.text(node.name, pt.x, pt.y+7, {color:"white", align:"center", font:"Arial", size:12})
            gfx.text(node.name, pt.x, pt.y+7, {color:"white", align:"center", font:"Arial", size:12})
          }else{*/
           // Load extra info
          var imageob = node.data.imageob
          var imageH = node.data.image_h-3
          var imageW = node.data.image_w
          var radius = parseInt(node.data.radius) 
          
            gfx.rect(pt.x-w/2, pt.y-8, w, 20, 4, {fill:node.data.color, alpha:node.data.alpha})
            gfx.text(node.data.label, pt.x, pt.y+9, {color:"white", align:"center", font:"Arial", size:12})
            gfx.text(node.data.label, pt.x, pt.y+9, {color:"white", align:"center", font:"Arial", size:12})
         // }
       /*   if (imageob){
              // Images are cached 
              ctx.drawImage(imageob, pt.x-(imageW/2), pt.y+radius/2, imageW, imageH)
            }
           */
        })
        that._drawVignette()
      },
      
      _drawVignette:function(){
        var w = canvas.width
        var h = canvas.height
        var r = 0
        //$( "#cy" ).attr({width: w , height: "600" });
//alert(w);
        if (!_vignette){
          var top = ctx.createLinearGradient(0,0,0,r)
          top.addColorStop(0, "#e0e0e0")
          top.addColorStop(.7, "rgba(255,255,255,0)")

          var bot = ctx.createLinearGradient(0,h-r,0,h)
          bot.addColorStop(0, "rgba(255,255,255,0)")
          bot.addColorStop(1, "white")

          _vignette = {top:top, bot:bot}
        }
        
        // top
        ctx.fillStyle = _vignette.top
        ctx.fillRect(0,0, w,r)

        // bot
        ctx.fillStyle = _vignette.bot
        ctx.fillRect(0,h-r, w,r)
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
      //alert(sys.getEdgesFrom(newSection).source);
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
            node.p.x = parent.p.x + .05*Math.random() - .025
            node.p.y = parent.p.y + .05*Math.random() - .025
            node.tempMass = .001
          }
        })
      },
      
      
      _initMouseHandling:function(){
        // no-nonsense drag and drop (thanks springy.js)
        selected = null;
        nearest = null;
        var dragged = null;
        var oldmass = 1

        var _section = null

        var handler = {
          moved:function(e){
            var pos = $(canvas).offset();
            _mouseP = arbor.Point(e.pageX-pos.left, e.pageY-pos.top)
            nearest = sys.nearest(_mouseP);

            if (!nearest.node) return false

            /* if (nearest.node.data.shape!='dot'){
              selected = (nearest.distance < 50) ? nearest : null
              if (selected){
                 dom.addClass('linkable')
               //  window.status = selected.node.data.link.replace(/^\//,"http://"+window.location.host+"/").replace(/^#/,'')
              }
              else{
                 dom.removeClass('linkable')
                // window.status = ''
              }
            }else */ 
          //  alert(nearest.node.name);
          // alert(hNodes.length);
           
           // alert($.inArray(nearest.node.name, hNodes));
            if ($.inArray(nearest.node.name, hNodes) >=0 ){
              if (nearest.node.name!=_section){
                _section = nearest.node.name
                that.switchSection(_section)
              }
              dom.removeClass('linkable')
              window.status = ''
            }
            
            return false
          },
          clicked:function(e){
            var pos = $(canvas).offset();
            _mouseP = arbor.Point(e.pageX-pos.left, e.pageY-pos.top)
            nearest = dragged = sys.nearest(_mouseP);
            
            if (nearest && selected && nearest.node===selected.node){
              var link = selected.node.data.link
              if (link.match(/^#/)){
                 $(that).trigger({type:"navigate", path:link.substr(1)})
              }else{
                 window.location = link
              }
              return false
            }
            
            
            if (dragged && dragged.node !== null) dragged.node.fixed = true

            $(canvas).unbind('mousemove', handler.moved);
            $(canvas).bind('mousemove', handler.dragged)
            $(window).bind('mouseup', handler.dropped)

            return false
          },
          dragged:function(e){
            var old_nearest = nearest && nearest.node._id
            var pos = $(canvas).offset();
            var s = arbor.Point(e.pageX-pos.left, e.pageY-pos.top)

            if (!nearest) return
            if (dragged !== null && dragged.node !== null){
              var p = sys.fromScreen(s)
              dragged.node.p = p
            }

            return false
          },

          dropped:function(e){
            if (dragged===null || dragged.node===undefined) return
            if (dragged.node !== null) dragged.node.fixed = false
            
		NodeStory(dragged.node.data.nodeid)
		//TimeLine(selected.node.data.nodeid)
		    // code for clicked node (dragged.node)		
	
            dragged.node.tempMass = 1000
            dragged = null;
            // selected = null
            $(canvas).unbind('mousemove', handler.dragged)
            $(window).unbind('mouseup', handler.dropped)
            $(canvas).bind('mousemove', handler.moved);
            _mouseP = null
            return false
          }


        }

        $(canvas).mousedown(handler.clicked);
        $(canvas).mousemove(handler.moved);

      }
    }
    
    return that
  }
  

    // helpers for figuring out where to draw arrows (thanks springy.js)
  /*  var intersect_line_line = function(p1, p2, p3, p4)
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
  */

  
//})(this.jQuery)

