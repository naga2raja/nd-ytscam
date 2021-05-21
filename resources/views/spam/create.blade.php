<x-app-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('define-spam-words.create') }}">{{ __('Define Spam Words') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Create Spam Words') }}</li>
          </ol>
        </nav>
    </x-slot>

    <div class="col-md-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200"> 
                    <div>
                         <a href="{{ route('spamwords.list') }}" class="btn btn-success pull-right rounded">  <i class="fa fa-arrow-left"></i> Back</a> 
                        <div style="clear: both;"></div> <br> 

                        @if($isPlanExpired)
                            <div class="alert alert-danger" role="alert" style="text-align: center;font-weight: bold;margin-top:20px;">Please Upgrade Your Plan</div>
                        @else

                        <form method="POST" action="{{ route('define-spam-words.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="spam_text" class="col-sm-2 col-form-label">Spam Word / Text</label>
                                <div class="col-sm-5">
                                  <input type="text" class="form-control" id="spam_text" name="spam_text" >
                                   @if($errors->any())
                                    <br>
                                        {!! implode('', $errors->all('<div class="error">:message</div>')) !!}
                                    @endif
                                </div>
                              </div>

                            <div class="form-group row">  
                              <div class="col-sm-2"> </div>
                              <div class="col-sm-5"> 
                                    <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                            </div>
                        </form>
                        @endIf
                        
                    </div>
                </div>
            </div>           
        </div>
    </div>    

</x-app-layout>