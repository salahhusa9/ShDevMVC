<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4" style="background-color: #7ed56f !important;">
      <a class="navbar-brand" href="#">My Blog (<?= $user->firstName ?? false ?>)</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#." onclick="$('#Madd').modal('show')">Add </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li> -->
        </ul>
        <!-- <form class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
      </div>
    </nav>
<main class="container">
    <h2>Article Table :</h2>
    <table id="article" class="display table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Date Post</th>
            </tr>
        </thead>
    </table>

    <!-- edit model -->
    <div class="modal fade" id="Madd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add :</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="MtitleAdd" placeholder="Blog ..." required>
            </div>
            <div class="form-group">
              <label for="Content">Content</label>
              <textarea class="form-control" id="McontentAdd" rows="3"></textarea>
            </div>
          </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveAdd">Save</button>
          </div>
        </div>
      </div>
    </div>

    <!-- edit model -->
    <div class="modal fade" id="Medit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit :</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="Mtitle" placeholder="Blog ..." required>
            </div>
            <div class="form-group">
              <label for="Content">Content</label>
              <textarea class="form-control" id="Mcontent" rows="3"></textarea>
            </div>
          </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveEdit" data-id="">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
    function relodTabel() {
      $('.btnRow').on('click',function (e) {
          console.log(e.target);
          var element = e.target;

          if (element.getAttribute('data-type') == "edit") {
            console.log('You click edit btn')
            document.getElementById('saveEdit').setAttribute( "data-id" , element.getAttribute('data-id'))
            $('#Mtitle').val(element.getAttribute('data-title'))
            $('#Mcontent').val(element.getAttribute('data-content'))
            $('#Medit').modal('show')
          
          }

          if (element.getAttribute('data-type') == "delete") {
            console.log('You click delete btn')

            $.ajax({
              url: 'article/delete',
              type: 'post',
              data: {id: element.getAttribute('data-id')},
              success: function(response){ 
                // Add response in Modal body
                $('#article').DataTable().ajax.reload();
              }
            });

          }

        })
    }
        $(document).ready(function() {
            var table=$('#article').DataTable( {
                "ajax": "article/api",
                "columns": [
                    { "data": "id" },
                    { "data": "title" },
                    { "data": "content" },
                    { "data": "" , className: 'btnRow'}
                ],
                columnDefs: [
                  {
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function (data, type, full, meta) {
                      return `
                        <button type="button" class="btn btn-outline-warning" onclick="relodTabel()" data-type="edit" data-id="`+full['id']+`" data-title="`+full['title']+`" data-content="`+full['content']+`">Edit</button>
                        <button type="button" class="btn btn-outline-danger" onclick="relodTabel()" data-id="`+full['id']+`" data-type="delete">Delete</button>
                      `;
                    }
                  }
                ],
                "initComplete": function(settings, json) {
                  // document.querySelector(".edit-btn").addEventListener("click", () => {console.log("99")});
                  // $('.btnRow').on('click',function (e) {
                  //   console.log(e.target);
                  //   console.log(json);
                  //   var element = e.target;

                  //   if (element.getAttribute('data-type') == "edit") {
                  //     console.log('You click edit btn')
                  //     document.getElementById('saveEdit').setAttribute( "data-id" , element.getAttribute('data-id'))
                  //     $('#Mtitle').val(element.getAttribute('data-title'))
                  //     $('#Mcontent').text(element.getAttribute('data-content'))
                  //     $('#Medit').modal('show')
                      
                  //   }

                  // })
                }
            } );

            $('#saveEdit').on('click',function (e) {
              console.log(e.target);

              var row=e.target;
              $.ajax({
                url: 'article/update',
                type: 'post',
                data: {
                  id: row.getAttribute('data-id') ,
                  title: $('#Mtitle').val() ,
                  content: $('#Mcontent').val() ,
                },
                success: function(response){ 
                  console.log(response);
                  
                  table.ajax.reload();
                  // Display Modal
                  $('#Medit').modal('hide'); 
                }
              });
            })

            $('#saveAdd').on('click',function (e) {
              console.log(e.target);

              var row=e.target;
              $.ajax({
                url: 'article/add',
                type: 'post',
                data: {
                  title: $('#MtitleAdd').val() ,
                  content: $('#McontentAdd').val() ,
                },
                success: function(response){ 
                  console.log(response);
                  table.ajax.reload();
                  // Display Modal
                  $('#Madd').modal('hide'); 
                }
              });
            })

            // $.ajax({
            //   url: 'ajaxfile.php',
            //   type: 'post',
            //   data: {userid: userid},
            //   success: function(response){ 
            //     // Add response in Modal body
            //     $('.modal-body').html(response);

            //     // Display Modal
            //     $('#empModal').modal('show'); 
            //   }
            // });
        } );
        
    </script>
</main>
</body>
</html>