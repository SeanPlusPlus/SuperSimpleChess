function trim(str) {
  return str.replace(/^\s+|\s+$/g, '');
}

function toggleFormVisibility()
{
  var frm_element = document.getElementById('msg_frm');
  var sub_link_element = document.getElementById('sub');
  var nosub_link_element = document.getElementById('nosub');
  var vis = frm_element.style;

  if(vis.display=='' || vis.display=='none') {
	  vis.display = 'block';
	  sub_link_element.style.display='none';
	  nosub_link_element.style.display='';
  } else {
	  vis.display = 'none';
	  sub_link_element.style.display='block';
	  nosub_link_element.style.display='none';
  }
}

function processFormData()
{
  var name_element = document.getElementById('myMsg');
  var name = trim(name_element.value);
  var error_message = 'The following fields had errors in them: \n\n';
  var error_flag = false;

  if(name == '') {
	  error_message += 'Please enter some text\n';
	  error_flag = true;
  } else {
      document.getElementById('myData').innerHTML += name;
  }
  if(error_flag) {
	  alert(error_message);
  }

}
