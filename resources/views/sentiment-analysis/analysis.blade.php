<x-app-layout>
    <x-slot name="header">        
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Sentiment Analysis</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('video') }}">Dashboard</a></li>                    
                    <li class="breadcrumb-item active">Sentiment Analysis</li>
                </ol>
                </div>
            </div>
            </div>
        </section>

    </x-slot>

    <div class="col-md-12">       

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200"> 
                    <div>

                        <div class="col-lg-12">          

                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h5 class="m-0">Enter your comment 
                                    <button type="button" class="btn btn-secondary pull-right" data-toggle="tooltip" data-placement="top" title="The Sentiment Analysis result includes your custom spam words and define not spam words also.">
                                        <i class="fa fa-info"></i>
                                    </button>
                            </h5>
                              </div>
                              <div class="card-body">
                                <form method="POST" action="{{ route('sentiment-analysis-check') }}">
                                    @csrf
                                    <div class="form-group row">                                        
                                        <div class="col-sm-12">
                                          <textarea class="form-control" rows="3" name="comment">@if(@$comment) {{ $comment }} @endif </textarea>                                           
                                        </div>
                                      </div>
        
                                    <div class="form-group row">                                      
                                      <div class="col-sm-12">
                                          <center> 
                                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                          </center>
                                      </div>
                                    </div>

                                    <div class="form-group row">                                      
                                        <div class="col-sm-12">
                                            @if(@$sentimentalStatus)
                                                <h3>Result</h3> <br>
                                                @if(!$spamFlag)
                                                    <div class="w3-col s4" id="positive"><i class="far fa-smile fa-5x"></i><br> <span class="black-text">State: </span> <b>Positive</b></div>
                                                @else
                                                    @if($sentimentalStatus == 'neg' || ($isDefinedSpam) )
                                                        <div class="w3-col s4" id="negative"><i class="far fa-frown fa-5x"></i><br><span class="black-text">State: </span><b>Negative</b></div>
                                                    @elseif($sentimentalStatus == 'neu')
                                                        <div class="w3-col s4" id="neutral"><i class="far fa-meh fa-5x"></i><br><span class="black-text">State: </span> <b>Neutral</b></div>  
                                                    @endif
                                                @endif

                                          @endif
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