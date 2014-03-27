// 通用
function redirect (url) 
{
  location.href=url;  
}

// fancybox #################################################################
$(document).ready(function() {
	$(".fancybox").fancybox();
  $("#left_ticket_box").pin({
      containerSelector: "#content"
  });
  $(".pinned").pin({
      minWidth: 940
  });
});

function fancyMessage(message)
{
	$.fancybox( '<h2 style="text-align:center;width: 320px; height: auto;">'+message+'</h2>' );
}

// 显示用户信息 ###############################################################
function showInfo(name,left_ticket,logout_url)
{
    //设置login box
		$("#login").html("");
		var html="<div id='user_info'>";
		html+="<span class='user_name'>"+name+"</span><br/>";
		html+="您还剩余&nbsp;<span class='left_ticket' id='left_ticket'>"+left_ticket+"</span>&nbsp;票<br/>";
		if(left_ticket != 0)
    {
      html+="<span id='login_text'>赶紧投票支持你喜欢的项目吧！</span>";
    }
    else
    {
      html+="<span id='login_text'>非常感谢您的支持！</span>";
    }
    
		html+="</div>";
		html+="<div id='button_box'>";
		html+="<button class='btn btn-large' onclick=redirect('"+logout_url+"')>注销登录</button>";
		html+="</div>";
		$("#login").html(html);

    //设置用户id
    $("#login").attr('data-logged',1);

    //设置left_ticket_box
    $("#left_ticket_box_text").html(left_ticket);
    $("#left_ticket_box").fadeToggle(1000);
}

// 设置已投 ###############################################################
function setVoted(voted)
{
  for (var i = voted.length - 1; i >= 0; i--) 
  {
    $("#btn"+voted[i]['project_id']).html("已投");
    $("#btn"+voted[i]['project_id']).attr("class","btn btn-success disabled");
    $("#btn"+voted[i]['project_id']).attr("onclick","");
  }
}


// 用户登录 #################################################################
$(document).ready(function(){
    $("#login_btn").click(function(){
            var username=$("#input_name").val();
            if(!username)
            {
              fancyMessage("学号/工号不能为空！");
              return false;
            }

            var password=$("#input_psw").val();
            if(!password)
            {
              fancyMessage("身份证号不能为空！");
              return false;
            }

            var url=$("#login_btn").attr("data-url");
            var response=$.ajax({
                url:url,
                type:'POST',
                data:{username:username,password:password},
                error: function(a,b,c){
                    alert(a+" "+b+" "+c);
                },
                success: function(){
                      var data=jQuery.parseJSON(response.responseText);
                      if(data.state=="success")
                      {
              			    fancyMessage(data.message);
              			    showInfo(data.name,data.left_ticket,data.logout_url);
                        setVoted(data.voted);
                       
                      }  
                      else if(data.state=="error")
                      {
                      	fancyMessage(data.message);
                      }
                      else
                      {
                      	fancyMessage("未知错误！");
                      }

	                }
	            });
	    	});
	});


// 用户投票 #################################################################
function vote(project_id)
{
    if( $("#login").attr('data-logged') != 0 )
    {
      var url=$("#content").attr("data-voteurl");
      var response=$.ajax({
                url:url,
                type:'POST',
                data:{project_id:project_id},
                error: function(a,b,c){
                    fancyMessage("未知错误！");
                },
                success: function(){
                      var data=jQuery.parseJSON(response.responseText);
                      if(data.state=="success")
                      {
                        // fancyMessage("已投"); 
                        //button replace
                        $("#btn"+project_id).html("已投");
                        $("#btn"+project_id).attr("class","btn btn-success disabled");
                        $("#btn"+project_id).attr("onclick","");
                        
                        //项目票数加1
                        var ticket=parseInt($("#ticket"+project_id).html())+1;
                        $("#ticket"+project_id).html(ticket);

                        //剩余票数减1
                        var left_ticket=parseInt($("#left_ticket").html())-1;
                        $("#left_ticket").html(left_ticket);
                        $("#left_ticket_box_text").html(left_ticket);
                        if(left_ticket == 0)
                        {
                          $("#login_text").html("非常感谢您的支持！");
                          fancyMessage("非常感谢您的支持！");
                        }
                      }  
                      else if(data.state=="error")
                      {
                        fancyMessage(data.message);
                      }
                      else
                      {
                        fancyMessage("未知错误！");
                      }
                  }
              });
    }
    else
    {
      fancyMessage("请登录后再投票！");
      $.scrollTo('#header',1000);
    }
}


// 项目筛选 #################################################################
//学院切换
$("#school_left").click(function(){
  var mid_html="<span class='btn btn-large choose' id='tel'>信通院</span>&nbsp;"
          +"<span class='btn btn-large choose' id='cs'>计算机</span>&nbsp;"
          +"<span class='btn btn-large choose' id='auto'>自动化</span>&nbsp;"
          +"<span class='btn btn-large choose' id='ele'>电子院</span>&nbsp;"
          +"<span class='btn btn-large choose' id='math'>理学院</span>&nbsp;"
          +"<span class='btn btn-large choose' id='hum'>人文院</span>&nbsp;"
          +"<span class='btn btn-large choose' id='enc'>经管院</span>";
  $("#school_middle").html(mid_html);
  $("#school_left").attr('class','school_left2');
  $("#school_right").attr('class','school_right');
  $(".choose").bind('click',function(){
    var id=$(this).attr('id');
    if(id == 'all')
    {
      $('.'+id).fadeIn(500);
    }
    else
    {
      $('.all').hide();
      $('.'+id).fadeIn(500);
    }
    $(".choose").attr('class',"btn btn-large choose");
    $("#"+id).attr('data-toggle',"button");
    $.scrollTo("#school_box");

  });
});

$("#school_right").click(function(){
  var mid_html="<span class='btn btn-large choose' id='int'>国际学院</span>&nbsp;"
      +"<span class='btn btn-large choose' id='soft'>软件学院</span>&nbsp;"
      +"<span class='btn btn-large choose' id='seven'>七维亦影</span>&nbsp;"
      +"<span class='btn btn-large choose' id='light'>光研院</span>&nbsp;"
      +"<span class='btn btn-large choose' id='tuan'>团委</span>&nbsp;"
      +"<span class='btn btn-large choose' id='sys'>创展服务</span>";
  $("#school_middle").html(mid_html);
  $("#school_right").attr('class','school_right2');
  $("#school_left").attr('class','school_left');
  $(".choose").bind('click',function(){
    var id=$(this).attr('id');
    if(id == 'all')
    {
      $('.'+id).fadeIn(500);
    }
    else
    {
      $('.all').hide();
      $('.'+id).fadeIn(500);
    }
    $(".choose").attr('class',"btn btn-large choose");
    $("#"+id).attr('data-toggle',"button");
    $.scrollTo("#school_box");

  });
});

$(".choose").click(function(){
  var id=$(this).attr('id');
  if(id == 'all')
  {
    $('.'+id).show();
  }
  else
  {
    $('.all').hide();
    $('.'+id).fadeIn(500);
  }
  $(".choose").attr('class',"btn btn-large choose");
  $("#"+id).attr('data-toggle',"button");
  $.scrollTo("#school_box");
});

// 项目搜索
$("#search_go").click(function(){
  var keyword = $('#search_keyword').val();
 
  if($('#project_'+keyword).length != 0)
  {
    $('.all').hide();
    $('#project_'+keyword).fadeIn(500);
  }
  else
  {
    fancyMessage("您搜索的项目不存在哦~");
  }

});


