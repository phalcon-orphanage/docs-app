$(document).ready(function() {
  var link = $('.article-content-edit-link').attr('href')
  var text = $('.article-content-edit-link').html()
  var editButton = '<a href=' + link + '><img src="/images/edit_pencil.svg" class="edit-pencil edit-pencil-h1" alt="' + text + '"/></a>'
  $( ".article-content h1" ).each(function() {
    $( ".article-content h1" ).after(editButton)
  })

  $(".article-content h2").each(function() {
    if(link.indexOf('crowdin') != -1){
      var editButton = '<a href=' + link + '><img src="/images/edit_pencil.svg" class="edit-pencil edit-pencil-h2" alt="' + text + '"/></a>'
    } else {
      var h2id = $(this).text().toLowerCase()
      var elemId = h2id.replace(/[^\w 0-9]/ug, "").replace(/\s/g, "-")
      $(this).attr('id', elemId)
      var editButton = '<a href=' + link + '/#' + elemId + '><img src="/images/edit_pencil.svg" class="edit-pencil edit-pencil-h2" alt="Edit ' + $(this).text() + ' on GitHub"/></a>'
    }
    $(this).after(editButton)
  })
})
