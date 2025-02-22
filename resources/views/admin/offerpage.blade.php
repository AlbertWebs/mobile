@extends('admin.master')

@section('content')
<div id="wrap" >
        

        <!-- HEADER SECTION -->
        @include('admin.top')
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
        @include('admin.left')
        <!--END MENU SECTION -->



        <!--PAGE CONTENT -->
        <div id="content">
             
            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h1> Offer Page </h1>
                    </div>
                </div>
                  <hr />
                 <!--BLOCK SECTION -->
                 <div class="row">
                    <div class="col-lg-12">
                        @include('admin.panel')

                    </div>

                </div>
                  <!--END BLOCK SECTION -->
                <hr />
                
               
                  <!-- Inner Content Here -->
                 
            <div class="inner">
                

              <div class="row">
               <center>
                 @if(Session::has('message'))
							   <div class="alert alert-success">{{ Session::get('message') }}</div>
				@endif

                @if(Session::has('messageError'))
							   <div class="alert alert-danger">{{ Session::get('messageError') }}</div>
				@endif
                 </center>
                 <div class="text-center alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                You Can <b>ONLY</b> have one hot offer at a time, Located in the Home Page Of Your Website.
                            </div>
                 
                 <form class="form-horizontal" method="post"  action="{{url('/admin/swap_offer')}}/{{$Product->id}}" enctype="multipart/form-data">
                    
                 <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Product name</label>

                        <div class="col-lg-8">
                            <input readonly type="text" id="text1" name="title" value="{{$Product->name}}" placeholder="e.g Travel Websites Emerging trends " class="form-control" />
                        </div>
                    </div>

                   

                   
                     <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Offer Type</label>
                    <div class="col-lg-8">
                        <select name="type" data-placeholder="Type Of Offer" class="form-control chzn-select" tabindex="2">
                            <option selected="selected" value="normal">normal</option>
                            <option  value="hot">hot</option>
                           

                        </select>
                        </div>
                        </div>
          
                        <div class="col-lg-12">
                         <div class="form-group">
                            <label for="limiter" class="control-label col-lg-4">Describe</label>

                            <div class="col-lg-8">
                                <textarea name="description" id="limiter" placeholder="New Collection Up to 50% OFF" class="form-control"></textarea>
                                <p class="help-block">Only Usable For Hot Offers</p>
                            </div>
                            
                        </div>
                        </div>
                        <div class="col-lg-12">
                        <div class="form-group">
                        <label class="control-label col-lg-4">Due Date</label>

                        <div class="col-lg-8">
                            <div class="input-group">
                                <input name="due" due class="form-control" type="text" data-mask="9999/99/99" />
                                <span class="input-group-addon">9999/99/99</span>
                            </div>
                            <p class="help-block">Only Usable For Hot Offers</p>
                        </div>
                    </div>
                   </div>

                   <div class="form-group">
                        <label class="control-label col-lg-4">Percentage off</label>

                        <div class="col-lg-8">
                            <div class="input-group">
                                <input name="percentage" class="form-control" type="text" data-mask="99%" />
                                <span class="input-group-addon">99%</span>
                            </div>
                            
                        </div>
                    </div>
                    <center>
                    <div class="form-group col-lg-12">
                  
                        <label class="control-label">featured Image</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="" alt="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="image" type="file" /></span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        
                    </div>
                    
                   
                   

                  

                   
                    </div>
                    </center>
                    <br><br>
                    <div class="col-lg-12 text-center">
                      <button type="submit" class="btn btn-success"><i class="icon-check icon-white"></i> Save Offer</button>
                    </div>
                    <input type="hidden" name="image_cheat" value="0">
                    
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                <form>
               
              </div>

            </div>
                  <!-- Inner Content Ends Here -->



                
            </div>

        </div>
        <!--END PAGE CONTENT -->

         <!-- RIGHT STRIP  SECTION -->
        @include('admin.right')
         <!-- END RIGHT STRIP  SECTION -->
    </div>

@endsection