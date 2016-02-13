function displayNewThreadForm() {
  var newThreadDiv = $('<div>', {
    class: 'new-thread-div'
  });
  var form = $('<form>', {
    action: '/php_example/new_thread',
    method: 'post',
    class: 'new-thread-form'
  });
  form.append($('<div class="new-thread-form-elem">').append($('<input>', {
      type: 'text',
      placeholder: 'Subject',
      name: 'subject',
      class:'new-thread-subject'
    })
  ));
  form.append(
    $('<div class="new-thread-form-elem">').append($('<textarea>', {
      name: 'body',
      class: 'new-thread-body',
      placeholder: 'Text'
    })
  ));
  form.append($('<input>', {
    type: 'submit',
  }));
  newThreadDiv.append(form);
  $('.new-thread-link').replaceWith(newThreadDiv);
}

$(document).ready(function() {
  $('.new-thread-link').click(displayNewThreadForm);
});
