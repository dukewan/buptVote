color=['blue','purple','green','yellow','red'];

// 用户登录 #################################################################
$(document).ready(function(){
    $("#login_btn").click(function(){
            var username=$("#input_name").val();
            if(!username)
            {
              alert("学号/工号还没填哦~");
              return;
            }

            var password=$("#input_psw").val();
            if(!password)
            {
              alert("身份证号还没填哦~");
              return;
            }

            var url=$("#login_btn").attr("data-url");
            var response=$.ajax({
                url:url,
                type:'POST',
                data:{username:username,password:password},
                error: function(){
                    alert("连接失败啦，去砸场子~");
                },
                success: function(){
                      var data=$.parseJSON(response.responseText);
                      if(data.state=="success")
                      {
                        location.href=data.mobile_url;
                      }  
                      else
                      {
                      	alert("验证失败啦，怎么破 -_-");
                      }
	                }
	            });
	    	});
	});

// 搜索项目 #################################################################
$(document).ready(function(){

  $('#search_btn').click(function(){
     $(this).animate({opacity: 0.5}, 100, 'ease-out',function(){
          $(this).animate({opacity: 1}, 100, 'ease-in');
      });
    var search=$('#search_inp').val();
    if(!search)
    {
      alert('啥也没写，猜您喜欢这几个项目~');
      getResult(0);
    }
    else
    {
      search=parseInt(search);
      if(!search)
      {
        alert('项目编号只能是数字哦~');
      }
      else
      {
        getResult(search);
      }
    }
  });
});

function showResult(result)
{
  var html="";
  var len=result.length;
  for(var i=0;i<len;i++)
  {
    html+="<div class='vote_box'>"
        +"<div class='column vote_box_project'>"
        +"<div class='column project_no "+color[i%5]+"_text'>"
        +"编号："+result[i].project_no
        +"</div>"
        +"<div class='column project_ticket "+color[i%5]+"_text'>"
        +"<span id='ticket"+result[i].project_id+"'>"+result[i].project_ticket+"</span>票"
        +"</div>"
        +"<div class='column project_name '>"
        +result[i].project_name
        +"</div>"
        +"</div>"
        +"<div id='btn"+result[i].project_id+"' class='column vote_btn white_text "+color[i%5]+"_background' onclick='vote("+result[i].project_id+")'>" 
        +"投票"
        +"</div>"
        +"</div>";
  }
  
  var content=$("#project_content");
  content.animate({opacity: 0}, 200, 'ease-out',function(){
      content.html("");
      content.html(html);
      content.animate({opacity: 1}, 400, 'ease-in');
    });
}

function getResult(project_no)
{
  var url=$('#search_btn').attr('data-searchurl');
  var response=$.ajax({
                url:url,
                type:'POST',
                data:{project_no:project_no},
                error: function(){
                    alert("连接失败啦，去砸场子~");
                },
                success: function(){
                      var data=$.parseJSON(response.responseText);
                      showResult(data.result);
                  }
              });
}


// 用户投票 #################################################################
function vote(project_id)
{
      var btn=$("#btn"+project_id);
      btn.animate({opacity: 0.5}, 100, 'ease-out',function(){
          btn.animate({opacity: 1}, 100, 'ease-in');
      });

      if($("#vote_header_username").attr("data-logged")!='1')
      {
        alert("没登录不能投票~");
        return;
      }
      var url=$("#vote_content").attr("data-voteurl");
      var response=$.ajax({
                url:url,
                type:'POST',
                data:{project_id:project_id},
                error: function(){
                    alert("连接失败啦，去砸场子~");
                },
                success: function(){
                      var data=$.parseJSON(response.responseText);
                      if(data.state=="success")
                      {
                        alert(data.message);

                        //文字提示
                        $("#btn"+project_id).html("已投");
                        
                        //项目票数加1
                        var tic=$("#ticket"+project_id);
                        var ticket=parseInt(tic.html())+1;
                        tic.html(ticket);

                        //剩余票数减1
                        var left=$("#left_ticket");
                        var left_ticket=parseInt(left.html())-1;
                        left.html(left_ticket);
                        if(left_ticket == 0)
                        {
                          alert("非常感谢您的参与！");
                        }
                      }  
                      else 
                      {
                        alert(data.message);
                      }
                  }
              });
}