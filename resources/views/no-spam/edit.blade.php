<x-app-layout>
    <x-slot name="header">
      <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Update Not Spam Words</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('video') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('no-spam-words.index') }}">Not Spam Words</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
            </div>
        </div>
        </div>
    </section>
    </x-slot>


            <div id="user_channels_list">
                <div class="current_channel_row">                   

                    <div class="row">                        
                        <div class="col-md-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 bg-white border-b border-gray-200"> 
                                        <div>

                                            <form method="POST" action="{{ route('no-spam-words.update', $spamWord->id) }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="PUT">
                                                <div class="form-group row">
                                                    <label for="spam_text" class="col-sm-2 col-form-label">Not Spam Word / Text</label>
                                                    <div class="col-sm-5">
                                                      <input type="text" class="form-control" id="spam_text" name="spam_text" value="{{ $spamWord->word }}"  maxlength="30">
                                                       @if($errors->any())
                                                        <br>
                                                            {!! implode('', $errors->all('<div class="error">:message</div>')) !!}
                                                        @endif
                                                    </div>
                                                  </div>

                                                <div class="form-group row">  
                                                  <div class="col-sm-2"> </div>
                                                  <div class="col-sm-5"> 
                                                        <button type="submit" class="btn btn-default">Save</button>
                                                  </div>
                                                </div>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>           
                            </div>
                        </div>
                    </div>
                    
            </div>
        </div>

   

</x-app-layout>
