<x-app-layout>
    <x-slot name="header">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Subscription</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active">Subscription</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
    </x-slot>

    <div class="col-md-12">
        <div class="card card-primary card-outline">                   

            <div id="user_channels_list">
                <div class="card-header current_channel_row">
                    <div class="col-md-12">                                
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4"> 
                                <a onclick="history.go(-1);" class="btn btn-success pull-right rounded">  <i class="fa fa-arrow-left"></i> Back</a> 
                                <div style="clear: both;"></div>
                            </div>                            
                        </div>
                    </div>
                    <br>

                    <div class="row">                        
                        <div class="col-md-12">
                              <div>
                                  <!-- <b> Basic plan </b>: Delete up to 10 Comments. -->
                                  <!-- You have used - {{ $deletedCommentsCount }} -->
                                  <table class="table">
                                      <thead class="thead-light">
                                          <tr>
                                              <th scope="col">#</th>
                                              <th scope="col">Plan name</th>
                                              <th scope="col">Comments Delete</th>
                                              <th scope="col">Price</th>
                                              <th scope="col">Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($subscriptionPlans as $key => $plan)
                                            <tr>
                                                <th scope="row"> {{ $key+1 }} </th>
                                                <td>
                                                   <strong> {{ $plan->name }} 
                                                   </strong>
                                                </td>
                                                <td> {{ $plan->delete_comments_count }} </td>
                                                <td>
                                                    $ {{ $plan->price }}
                                                </td>
                                                <td>
                                                    @if($currentPlan->plan_id == $plan->id)
                                                        <a href="#" class="btn btn-success"> Active </a>
                                                    @else
                                                        @if($plan->id == 1)
                                                            @if($currentPlan->plan_id > 1) 
                                                                - 
                                                            @else
                                                                <a href="/subscribe-now/{{$plan->id}}" class="btn btn-primary">Subscribe Now</a>
                                                            @endIf

                                                        @elseif($plan->id == 2)
                                                            <a href="#pricingEnquiryModal" class="btn btn-primary" style="background: #c0c0c0;border-color: #c0c0c0;" data-toggle="modal" data-target="#pricingEnquiryModal" data-whatever="{{ $plan->name }}">Subscribe Now</a>
                                                        @else
                                                            <a href="#pricingEnquiryModal" class="btn btn-warning" data-toggle="modal" data-target="#pricingEnquiryModal" data-whatever="{{ $plan->name }}">Subscribe Now</a>
                                                        @endif
                                                   @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>                            
                                  </table>
                                     
                            </div>
                        </div>
                    </div>

                    <!-- pop-up -->

                    <div class="modal fade" id="pricingEnquiryModal" tabindex="-1" role="dialog" aria-labelledby="pricingEnquiryModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <form action="/subscribe-plan" method="post" role="form" class="php-email-form">
                          <div class="modal-header">
                            <h5 class="modal-title" id="pricingEnquiryModalLabel">Contact us</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            @csrf 
                              <div class="form-group">
                                <label for="recipient_name" class="col-form-label">Plan:</label>
                                <input type="text" class="form-control" name="recipient_name" id="recipient_name" readonly>
                                <div class="validate"></div>
                              </div>
                              <div class="form-group">
                                <label for="your_name" class="col-form-label">Your Name:</label>
                                <input type="text" class="form-control" name="your_name"  id="your_name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="{{ Auth::user()->name }}">
                                <div class="validate"></div>
                              </div>            
                              <div class="form-group">
                                <label for="your-email" class="col-form-label">Your Email:</label>
                                <input type="email" class="form-control" name="your_email" id="your_email"  data-rule="email" data-msg="Please enter a valid email" value="{{ Auth::user()->email }}">
                                <div class="validate"></div>
                              </div>
                              <div class="form-group">
                                <label for="message_text" class="col-form-label">Message:</label>
                                <textarea class="form-control" name="message_text" id="message_text" data-rule="required" data-msg="Please write something for us"></textarea>
                                <div class="validate"></div>
                              </div>
                            
                          </div>
                          <div class="modal-footer">
                            
                              <div class="loading" style="display: none;">Loading</div>
                              <div class="error-message" ></div>
                              <div class="sent-message" style="display: none;">Your message has been sent. Thank you!</div>
                            
                            
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                          </div>
                        </form>
                  
                        </div>
                      </div>
                    </div>
                    <!-- end pop-up -->
                    
              </div>
          </div>

      </div>
  </div>


    
    

    @push('scripts')
    <script>
        
        $('#pricingEnquiryModal').on('show.bs.modal', function (event) {
            $('#pricingEnquiryModal .sent-message').hide();
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Contact for ' + recipient)
            modal.find('.modal-body input[id=recipient_name]').val(recipient)
    })
    </script> 
    @endpush

</x-app-layout>
