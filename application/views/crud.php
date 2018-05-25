<!DOCTYPE html>
<html>
    <head>
        <title>CRUD Generator</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript">base_url="<?=  base_url()?>"</script>
        <link rel="stylesheet" href="<?=  base_url()?>assets/css/custom.css" >
    </head>
    <body class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary main-panel">
                        <div class="panel-heading">CRUD Generator</div>
                        <div class="panel-body">
                            <form id="crud_form" method="POST" action="">
                                <div class="form-group">
                                    <label>No of Fields</label>
                                    <input id="fields_no" name="fields_no"  class="form-control"  value=""/>
                                </div>
                                <div class="form-group">
                                    <label>Table Name in Database</label>
                                    <input id="table_name" name="table_name"  class="form-control"  value=""/>
                                </div>
                                <div class="fields">
                                </div>
                                <div class="text-center">
                                    <span id="submit" class="btn btn-primary">Generate Code</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row tabs_div">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active" ><a data-toggle="tab" href="#add_tab">Add</a></li>
                                <li class="" ><a data-toggle="tab" href="#edit_tab">Edit</a></li>
                                <li class="" ><a data-toggle="tab" href="#delete_tab">Delete</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="add_tab">Add</div>
                                <div class="tab-pane fade" id="edit_tab">Edit</div>
                                <div class="tab-pane fade" id="delete_tab">Delete</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <script src="<?=  base_url()?>assets/js/custom.js" type="text/javascript" ></script>
    </body>
</html>