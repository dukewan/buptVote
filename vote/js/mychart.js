// 图表 #################################################################
ctx = $("#myChart").get(0).getContext("2d");
myChart=new Chart(ctx);
data = {
          labels : ["","","","","","","","","",""],
          datasets : [
                        {
                          fillColor : "rgba(18,170,235,0.7)",
                          strokeColor : "rgba(18,170,235,1)",
                          data : [,,,,,,,,,]
                        },
                      ]
        };
options = {
  //Boolean - If we show the scale above the chart data     
  scaleOverlay : false,
  
  //Boolean - If we want to override with a hard coded scale
  scaleOverride : true,
  
  //** Required if scaleOverride is true **
  //Number - The number of steps in a hard coded scale
  scaleSteps : 20,
  //Number - The value jump in the hard coded scale
  scaleStepWidth : 10,
  //Number - The scale starting value
  scaleStartValue : 0,

  //String - Colour of the scale line 
  scaleLineColor : "rgba(0,0,0,.1)",
  
  //Number - Pixel width of the scale line  
  scaleLineWidth : 1,

  //Boolean - Whether to show labels on the scale 
  scaleShowLabels : true,
  
  //Interpolated JS string - can access value
  scaleLabel : "<%=value+'票'%>",
  
  //String - Scale label font declaration for the scale label
  scaleFontFamily : "'微软雅黑'",
  
  //Number - Scale label font size in pixels  
  scaleFontSize : 13,
  
  //String - Scale label font weight style  
  scaleFontStyle : "bold",
  
  //String - Scale label font colour  
  scaleFontColor : "#666",  
  
  ///Boolean - Whether grid lines are shown across the chart
  scaleShowGridLines : true,
  
  //String - Colour of the grid lines
  scaleGridLineColor : "rgba(0,0,0,.05)",
  
  //Number - Width of the grid lines
  scaleGridLineWidth : 1, 

  //Boolean - If there is a stroke on each bar  
  barShowStroke : true,
  
  //Number - Pixel width of the bar stroke  
  barStrokeWidth : 2,
  
  //Number - Spacing between each of the X value sets
  barValueSpacing : 10,
  
  //Number - Spacing between data sets within X values
  barDatasetSpacing : 1,
  
  //Boolean - Whether to animate the chart
  animation : true,

  //Number - Number of animation steps
  animationSteps : 60,
  
  //String - Animation easing effect
  animationEasing : "easeOutQuart",

  //Function - Fires when the animation is complete
  onAnimationComplete : null,

};

function setOptions(max)
{

   var width; 
   if(max < 90 && max > 40)
   {
      width = parseInt((parseInt(max / 18) + 8) / 10) * 10;
   }
   else
   {
      width = parseInt((parseInt(max / 15) + 5) / 10) * 10;
   }
    
   if(width < 10)
   {
      width = 2;
   }

   options['scaleStepWidth'] = width;
}

function setLables(label)
{
  for (var i = 0;i <= label.length - 1; i++) 
  {
    $("#label_name_"+(i+1)).html(label[i]);
  };
}


//从服务端取top10数据（编号、名称、票数）
function getTop10Data(url)
{
  var response=$.ajax({
                url:url,
                type:'POST',
                error: function(a,b,c){
                    alert("给服务器跪了 -_-#");
                },
                success: function(){
                      var top10=$.parseJSON(response.responseText);
                      var label=new Array(10);
                      var len = top10.length;
                      for (var i = 0;i <= len - 1;  i++) 
                      {
                        label[i] = "编号:"+top10[i][0]+"<br/>"+top10[i][1];
                        data['datasets'][0]['data'][i] = top10[i][2];
                      };
                      
                      setLables(label);
                      setOptions(data['datasets'][0]['data'][0]);
                      myChart.Bar(data,options);
                  }
              });
}

//绘制表格
function drawChart()
{
  var url = $("#url").attr('data-url');
  getTop10Data(url);
  window.setInterval(function(){getTop10Data(url)}, 10000); 
}

$(document).ready(function(){
  drawChart();
});
