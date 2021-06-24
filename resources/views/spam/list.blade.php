<x-app-layout>
    <x-slot name="header">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Custom Words</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('video') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Custom Words</li>
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
                                        <form method="GET" class="row">
                                            <div class="col-md-4">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Search" value="{{ $searchValue }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="submit" name="submit" value="Search" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-4"> 
                                        <a href="{{ route('define-spam-words.create') }}" class="btn btn-success pull-right rounded">Add  <i class="fa fa-plus"></i></a>
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
                                               <th scope="col">Spam Word / Text</th>
                                               <th scope="col" colspan="2">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($spamWords as $key => $word)
                                            <tr>
                                                <th scope="row"> {{ $key+1 }} </th>
                                                <td>
                                                    {{ $word->spam_word }} 
                                                </td>                                    
                                                <td width="30px">
                                                    <a class="btn btn-primary" href="{{ route('define-spam-words.edit', $word->id) }}"> <i class="fa fa-pencil"></i></a>
                                                </td>
                                                <td width="30px">
                                                    <form onsubmit="return confirm('Are you sure?')" action="{{ route('define-spam-words.destroy', $word->id)}}" method="post">
                                                       @method('DELETE')
                                                       @csrf
                                                       <button class="btn btn-danger" type="submit"> <i class="fa fa-trash"></i> </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach   
                                        @if(!count($spamWords)) 
                                            <tr>
                                                <td colspan="4">
                                                    <div class="alert alert-danger"> No data found!</div>
                                                </td>
                                            </tr>
                                        @endif
                                            <tr>
                                                <td colspan="4">
                                                    <div class="d-flex justify-content-center cabcs-pagination">
                                                        {{ $spamWords->links() }}
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
