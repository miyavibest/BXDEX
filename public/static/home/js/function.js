/* 密码框显示文字 */
$("#password_icon").click(function() {
  var type = $("#password").attr('type');
  if (type == 'password') {
    $("#password").attr('type', 'text');
    $(this).addClass('show');
  } else {
    $("#password").attr('type', 'password');
    $(this).removeClass('show');
  }
})

/* 验证表单 */
$("#checkForm").validate({
  rules: rules,
  messages: messages,
  /* 重写错误显示消息方法,以alert方式弹出错误消息 */
  showErrors: function(errorMap, errorList) {
    var msg = "";
    $.each(errorList, function(i, v) {
      if (i <= 0) {
        msg = (v.message);
      }
    });
    if (msg != ""){
      zdalert('系统提示',msg);
      $(".button").attr('disabled',false);
    }
  },
  onfocusout: false,
  onkeyup: false
});

/* 后台表单验证 */
$("#checkAdminForm").validate({
  rules: rules,
  messages: messages
});

/* 发送短信 */
$("#getRegisterCode").on('click', function() {
  var isNext = true;
  if (!isNext) {
    return false;
  }
  var btnObj = $(this); 
  var time = 60;
  var phone = $("#phone").val();
  var url = $(this).attr('codeUrl');
  if(!phone){
    zdalert('系统提示','请输入手机号');
    return false;
  }
  $.ajax({
    type: "POST",
    cache: false,
    url: url,
    data: "phone=" + phone,
    success: function(res) {
      // alert(res);
      // $("#code").val(res);
      if(res < 0){
        switch(res){
          case '-1' : res = '短信用户名密码不正确'; break;
          case '-2' : res = '内容不能大于70个字'; break;
          case '-3' : res = '验证此平台是否存在'; break;
          case '-4' : res = '提交号码不能为空或客户余额为0'; break;
          case '-5' : res = '剩余条数不够要发送的短信数量'; break;
          case '-6' : res = '非法短信内容'; break;
          case '-7' : res = '返回系统故障'; break;
          case '-8' : res = '网络错误,稍后再试'; break;
        }
        zdalert('系统提示','发送失败'+res);
      }else{
        zdalert('系统提示','短信发送成功');
      }
    }
  })
  isNext = false;
  var t = setInterval(function() {
    time--;
    btnObj.val(time + "秒");
    btnObj.prop('disabled', true);
    if (time == 0) {
      clearInterval(t);
      btnObj.val("获取验证码");
      $(this).prop('disabled', false);
      isNext = true;
    }
  }, 1000)
})

function changecheckin(){
  var checkin = document.getElementById("checkin");
  checkin.value = 4;
}
function xxx(){

}

$(document).on('change',"#selectAll",function(){
  $("input[name='id[]']").prop('checked',this.checked);
})
