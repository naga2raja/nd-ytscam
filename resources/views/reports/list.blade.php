<x-app-layout>
    <x-slot name="header">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Deletion Report</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('video') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Deletion Report</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
    </x-slot>


    <div class="col-md-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        </div>        

        <div class="row">                         
            <div class="col-md-12">
                <div class="card card-primary card-outline">                   

                    <div id="user_channels_list">
                        <div class="card-header current_channel_row">
                            <div class="col-md-12">                                
                                <div class="row">
                                    <div class="col-md-8"> 
                                        <!--
                                        <form method="GET" class="row">
                                            <div class="col-md-4">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Search" value="">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="submit" name="submit" value="Search" class="btn btn-primary">
                                            </div>
                                        </form> -->
                                    </div>
                                    <div class="col-md-4"> 
                                        <a href="{{ route('download') }}?download=true" class="btn btn-success pull-right rounded">  <i class="fa fa-download"></i>  Download </a>
                                    </div>                            
                                </div>
                            </div>
                            <br>

                            <div class="col-md-12">                                
                                <div class="row">
                                    <!-- Table -->
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                               <th scope="col">#</th>
                                               <th scope="col">Comment Id</th>
                                               <th scope="col">Comment</th>
                                               <th scope="col">Deleted On</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($data as $key => $word)
                                            <tr>
                                                <th width="30px"> {{ $key+1 }} </th>
                                                <td>
                                                    {{ $word->yt_comment_id }} 
                                                </td>                                    
                                                <td>
                                                    {{ $word->yt_comment }}
                                                </td>
                                                <td>
                                                    {{ $word->created_at }}
                                                </td>
                                            </tr>
                                        @endforeach   
                                        @if(!count($data)) 
                                            <tr>
                                                <td colspan="4">
                                                    <div class="alert alert-danger"> No data found!</div>
                                                </td>
                                            </tr>
                                        @endif
                                            <tr>
                                                <td colspan="4">
                                                    <div class="d-flex justify-content-center cabcs-pagination">
                                                        {{ $data->links() }}
                                                    </div>
                                                </td>
                                            </tr>
                                      </tbody>
                                    </table>  
                                    <!-- End Table -->
                                </div>
                                <div style="clear:both;"></div>
                            </div>

                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>  
    

</x-app-layout>
