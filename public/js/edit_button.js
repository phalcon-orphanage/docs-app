$(document).ready(function() {
  var link = $('.article-content-edit-link').attr('href')
  var editButton = "<a href=" + link + "><img src='/images/edit_pencil.svg' class='edit-pencil' alt='Edit'/></a>"
  $( ".article-content h1" ).each(function() {
    $( ".article-content h1" ).append(editButton)
  })

  $(".article-content h2").each(function() {
    var h2id = $(this).text().toLowerCase()
    var elemId = h2id.replace(/[^\w 0-9]/ug, "").replace(/\s/g, "-")
    $(this).attr('id', elemId)
    var editButton = "<a href=" + link + "/#" + elemId + "><img src='/images/edit_pencil.svg' class='edit-pencil' alt='Edit'/></a>"
    $(this).append(editButton)
  })
})
