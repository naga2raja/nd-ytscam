<x-app-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Custom Words') }}</li>
          </ol>
        </nav>
    </x-slot>

    

    <div class="col-md-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200"> 
                    <div>
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
                        <div style="clear: both;"></div> <br> 

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
                        
                    </div>

                </div>
            </div>           
        </div>
    </div>    

</x-app-layout>
