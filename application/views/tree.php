

<h1>Entity Visualization</h1>
<?php 
if (isset($list))
{	
	echo $list;
} 
else
{
?>
	<div id="search">
		<p><?php echo $error;?></p>
		<?php // echo language(); ?>
		<form name="oi" action="<?php echo base_url() . index_page();?>/trees/entitylist" method="post"> 
		<input type="text" name="search_name" value="" />
		<input type="submit" name="submit" value="SEARCH" />
		</form>
	</div>
<?php
}

if (!empty($tree)){	
 //echo $tree;
 
?>



<!--[if IE]><script language="javascript" type="text/javascript" src="/assets/excanvas.js"></script><![endif]-->

<!-- JIT Library File -->
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/jit.js"></script>

<!-- Example File -->
<script language="javascript" type="text/javascript">
	var labelType, useGradients, nativeTextSupport, animate;

(function() {
  var ua = navigator.userAgent,
      iStuff = ua.match(/iPhone/i) || ua.match(/iPad/i),
      typeOfCanvas = typeof HTMLCanvasElement,
      nativeCanvasSupport = (typeOfCanvas == 'object' || typeOfCanvas == 'function'),
      textSupport = nativeCanvasSupport 
        && (typeof document.createElement('canvas').getContext('2d').fillText == 'function');
  //I'm setting this based on the fact that ExCanvas provides text support for IE
  //and that as of today iPhone/iPad current text support is lame
  labelType = (!nativeCanvasSupport || (textSupport && !iStuff))? 'Native' : 'HTML';
  nativeTextSupport = labelType == 'Native';
  useGradients = nativeCanvasSupport;
  animate = !(iStuff || !nativeCanvasSupport);
})();

var Log = {
  elem: false,
  write: function(text){
    if (!this.elem) 
      this.elem = document.getElementById('log');
    this.elem.innerHTML = text;
    this.elem.style.left = (500 - this.elem.offsetWidth / 2) + 'px';
  }
};


function init(){
  // init data
  var json = [<?php echo json_decode($tree); ?>];
 
 
var jsonpie = {  
  'id': 'root',  
  'name': 'RGraph based Pie Chart',  
  'data': {  
      '$type': 'none'  
  },  
  'children':[  
    {  
        'id':'pie1',  
        'name': 'pie1',  
        'data': {  
            '$angularWidth': 20,  
            '$color': '#55f'  
        },  
        'children': []  
    },  
    {  
        'id':'pie2',  
        'name': 'pie2',  
        'data': {  
            '$angularWidth': 40,  
            '$color': '#77f'  
        },  
        'children': []  
    },  
    {  
        'id':'pie3',  
        'name': 'pie3',  
        'data': {  
            '$angularWidth': 10,  
            '$color': '#99f'  
        },  
        'children': []  
    },  
    {  
        'id':'pie4',  
        'name': 'pie4',  
        'data': {  
            '$angularWidth': 30,  
            '$color': '#bbf'  
        },  
        'children': []  
    }  
  ]  
};  
  // end
 //init nodetypes
    //Here we implement custom node rendering types for the RGraph
    //Using this feature requires some javascript and canvas experience.
    $jit.RGraph.Plot.NodeTypes.implement({
        //This node type is used for plotting pie-chart slices as nodes
        'shortnodepie': {
          'render': function(node, canvas) {
            var ldist = this.config.levelDistance;
            var span = node.angleSpan, begin = span.begin, end = span.end;
            var polarNode = node.pos.getp(true);
            
            var polar = new $jit.Polar(polarNode.rho, begin);
            var p1coord = polar.getc(true);
            
            polar.theta = end;
            var p2coord = polar.getc(true);
            
            polar.rho += ldist;
            var p3coord = polar.getc(true);
            
            polar.theta = begin;
            var p4coord = polar.getc(true);
            
            
            var ctx = canvas.getCtx();
            ctx.beginPath();
            ctx.moveTo(p1coord.x, p1coord.y);
            ctx.lineTo(p4coord.x, p4coord.y);
            ctx.moveTo(0, 0);
            ctx.arc(0, 0, polarNode.rho, begin, end, false);

            ctx.moveTo(p2coord.x, p2coord.y);
            ctx.lineTo(p3coord.x, p3coord.y);
            ctx.moveTo(0, 0);
            ctx.arc(0, 0, polarNode.rho + ldist, end, begin, true);
            
            ctx.fill();
          }
        }
    });
    
    $jit.ST.Plot.NodeTypes.implement({
        //Create a new node type that renders an entire RGraph visualization
        'piechart': {
          'render': function(node, canvas, animating) {
            var ctx = canvas.getCtx(), pos = node.pos.getc(true);
            ctx.save();
            ctx.translate(pos.x, pos.y);
            pie.plot();
            ctx.restore();
          }
        }
    });
    //end
    
    //init pie
    var pie = new $jit.RGraph({
        'injectInto': 'infovis',
        //Add node/edge styles and set
        //overridable=true if you want your
        //styles to be individually overriden
        Node: {
            'overridable': true,
             'type':'shortnodepie'
        },
        Edge: {
            'type':'none'
        },
        //Parent-children distance
        levelDistance: 15,
        //Don't create labels for this visualization
        withLabels: false,
        //Don't clear the canvas when plotting
        clearCanvas: false
    });
    //load graph.
    pie.loadJSON(jsonpie);
    pie.compute();
    //end

    //init st
    var st = new $jit.ST({
        useCanvas: pie.canvas,
        orientation: 'bottom',
        //Add node/edge styles
        Node: {
           type: 'piechart',
           width: 60,
           height: 60
        },
        Edge: {
            color: '#999',
            type: 'quadratic:begin'
        },
        //Parent-children distance
        levelDistance: 60,

        //Add styles to node labels on label creation
        onCreateLabel: function(domElement, node){
            //add some styles to the node label
            var style = domElement.style;
            domElement.id = node.id;
            style.color = '#000';
            style.fontSize = '0.8em';
            style.textAlign = 'center';
            style.width = "60px";
            style.height = "24px";
            style.paddingTop = "22px";
            style.cursor = 'pointer';
            domElement.innerHTML = node.name;
            domElement.onclick = function() {
              st.onClick(node.id, {
                    Move: {
                        offsetY: -90
                    }
                });  
            };
        }
    });
    //load json data
    st.loadJSON(json);
    //compute node positions and layout
    st.compute();
    //optional: make a translation of the tree
    st.geom.translate(new $jit.Complex(0, 200), "start");
    //Emulate a click on the root node.
    st.onClick(st.root, {
        Move: {
            offsetY: -90
        }
    });
    //end
  // end
}
</script>
<div id="container_vis">
	<div id="center-container">
	    	<div id="infovis"></div>
	</div>
	<div id="right-container">
		<div id="inner-details"></div>
	</div>
	<div id="log"></div>
</div>
  <?php echo '<script language="javascript" >window.onload=init;</script>'; } ?>

