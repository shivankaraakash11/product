<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Product</title>
    <style>
        .container-fluid{
            background-color:white;
            text-align:left;
            color:black;
            padding: 20px;
        }
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
    </style>
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column ">
    <header class="mb-auto">
        <div>
        <h3 class="float-md-start mb-0">Product</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link active" aria-current="page" href="<?php echo base_url();?>">Home</a>
            <a class="nav-link" href="<?php echo base_url();?>Category">Product Category</a>
            <a class="nav-link" href="<?php echo base_url();?>Product">Product</a>
        </nav>
        </div>
    </header>

    <main class="px-3">
        <h1>Add Product Category </h1>
        <div class="container-fluid">
            <div class="row">

            <!-- Message Code Start-->

                <div class="col-mg-12">
                
                    <?php

                    $all = $this->messages->get();

                    foreach($all as $type=>$messages)

                    {

                    foreach($messages as $message)

                    {

                        ?>

                        <div class="alert  alert-dismissable <?php echo $type; ?>">

                        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>

                        <?php

                        if($type=='alert-danger')

                        {

                            ?>

                            <span class="glyphicon glyphicon-exclamation-sign"></span>

                            <?php

                        }

                        if($type=='alert-success')

                        {

                            ?>

                            <span class="glyphicon glyphicon-ok"></span>

                            <?php

                        }

                        if($type=='alert-info')

                        {

                            ?>

                            <span class="glyphicon glyphicon-info-sign"></span>

                            <?php

                        }

                        if($type=='alert-warning')

                        {

                            ?>

                            <span class="glyphicon glyphicon-alert"></span>

                            <?php

                        }

                        ?>

                        <?php echo $message; ?>

                        </div>

                        <?php

                    }

                    }

                    ?>
                </div>

                <!-- Message Code End-->


                <div class="col-lg-6">
                    <?php if($single_data){ ?>
                        <form action="<?php echo base_url();?>Category/edit_save" method="POST">
                            <input type="hidden" value="<?php echo $single_data->id;?>" name="id">
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" class="form-control" value="<?php echo $single_data->category_name;?>"  name="category_name" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>
                  <?php  } else{ ?>
                    <form action="<?php echo base_url();?>Category/save" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                    <?php } ?>
                </div>
                <div class="col-lg-6">
                <table class="table table-bordered table-stripped text-center">
                    <thead>
                        <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $category=$this->Admin_model->getRows('select * from product_category');
                        $i=1;
                        foreach($category as $categorys){ ?>
                        <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $categorys->category_name;?></td>
                        <td>
                            <a class="btn btn-primary" href="<?php echo base_url();?>Category/edit/<?php echo $categorys->id;?>">Edit</a>

                            <a class="btn btn-danger" href="<?php echo base_url();?>Category/delete/<?php echo $categorys->id;?>">Delete</a>
                        </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>