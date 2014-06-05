$(document).ready(function(){  
var baseurl  = $('#baseurl').val(); // baseurl
var realstatus; // текущий индификатор статуса
var multipleValues; // значения необходимых статусов в виде: "0, 1, 2"
var timerId; // Индификатор для таймера
timetoupdate = $('#timer > b').html();

$('body').on('change', '#status',function() {
  change = true;
  realstatus = null;
  status = $('#status').val();
  if(status < 0 || status > 5){
	  alert('Значеиния индификатора должны находиться в границах от 1 до 5');
  }
  else{realstatus = status}
});

$('#next').bind( "click", function() {
	next();
});
/*
	Выборка следующей записи / принятие изменений.
*/
function next(){
	multipleValues = $( "#stateIds" ).val() || [];
	multipleValues=multipleValues.join( ", " );
	cid = $('#cid').text();
	if(realstatus){
		sendReq(true,multipleValues,cid,realstatus);
	}
	else{
	   sendReq(true,multipleValues,cid);
	}
	status = null;
	realstatus = null;
	// сброс/обновление/запуск таймера 
	$('#timer').show();
	clearInterval(timerId);
	$('#timer > b').html(timetoupdate);
	timer_interval();
}

function timer_interval() {
  var i = $('#timer > b').html();
   timerId = setInterval(function() {
    if (i-1 == 0) {
    	clearInterval(timerId);
	    next();
    }
    i--;
     $('#timer > b').html(i); 
  }, 1000);
}


/*
Отправка запроса
next - необходимо ли выбирать следующую строку?
multipleValues - список статусов
cid - текущий индификатор контакта
realstatus - новое значение если статус был изменен
*/
function sendReq(next,multipleValues,cid,realstatus){
	 realstatus = realstatus || -1;
	 $.ajax({
		  type: "POST",
		  url: baseurl+"enigne/api.php",
		  data: { next:next, statusArray: multipleValues, userId:cid,status:realstatus}
	  })
	  .done(function( msg ) {
		  var vals = jQuery.parseJSON(msg);
		  if(vals.phone == null)
		  {
		 	 $('#appendHere').empty();
		 	 $('#appendHere').append( "<td class='alert-danger'>В данный момент у нас нет свободных номеров подходящего статуса</td>" );
		  }
		  else{
			  $('#appendHere').empty();
			  status = vals.status;
			  $('#appendHere').append("<td id='cid'>"+vals.contactId+"</td><td>"+vals.phone+"</td><td><input type='text' id='status' value='"+vals.status+"' /></td>");
	  }
  });
}

//Освобождение занятого ресурса при закрытии где это возможно
window.onbeforeunload = function() {
 cid = $('#cid').text();
 sendReq(false,null,cid);
};





});
