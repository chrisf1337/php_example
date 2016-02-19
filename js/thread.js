function getQueryVariable(variable)
{
   var query = window.location.search.substring(1);
   var vars = query.split("&");
   for (var i=0; i < vars.length; i++) {
      var pair = vars[i].split("=");
      if (pair[0] == variable) {
        return pair[1];
      }
   }
   return false;
}

function displayReplyForm() {
  var replyDiv = $('<div>', {
    class: 'reply-div'
  });
  var form = $('<form>', {
    action: '/php_example/reply',
    method: 'post',
    class: 'reply-form'
  });
  form.append($('<div class="reply-form-elem">').append($('<input>', {
      type: 'text',
      placeholder: 'Subject',
      name: 'subject',
      class:'reply-subject',
      autocomplete: 'off'
    })
  ));
  form.append(
    $('<div class="reply-form-elem">').append($('<textarea>', {
      name: 'body',
      class: 'reply-body',
      placeholder: 'Text'
    })
  ));
  form.append($('<input>', {
    type: 'hidden',
    'name': 'thread',
    'value': getQueryVariable('id')
  }));
  form.append($('<input>', {
    type: 'submit',
  }));
  replyDiv.append(form);
  $('.reply-link').replaceWith(replyDiv);
}

$(document).ready(function() {
  $('.reply-link').click(displayReplyForm);
});
