
const close=document.querySelector(".close");  
  const open=document.querySelector(".ham");  
  const menu=document.querySelector(".menu")  
  close.addEventListener("click",()=>{  
    menu.style.visibility="hidden";  
  })  
  open.addEventListener("click",()=>{  
    menu.style.visibility="visible";  
  })  
  function send_message(){
    var name=jQuery('#name').val();
    var email=jQuery('#email').val();
    var mobile=jQuery('#mobile').val();
    var comment=jQuery('#comment').val();
    var is_error="";
    if(name==""){
      alert('Please enter your name');
    }else if(email==""){
      alert('Please enter your email');
    }else if(mobile==""){
      alert('Please enter your mobile');
    }else if(comment==""){
      alert('Please enter your message');
    }else{
      $.ajax({
        url:'send_message.php',
        type:'post',
        data:'name='+name+'&email='+email+'&mobile='+mobile+'&comment='+comment,
        success:function(result){
          alert(result);
        }
      });
    }
  }
  
