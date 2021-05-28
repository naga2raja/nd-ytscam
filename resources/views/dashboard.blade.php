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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Welcome, You're logged in!
                    <br> --> <br> 
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
                                                <a href="/subscribe-now/{{$plan->id}}" class="btn btn-primary">Subscribe Now</a>
                                            @elseif($plan->id == 2)
                                                <a href="/subscribe-now/{{$plan->id}}" class="btn btn-primary" style="background: #c0c0c0;border-color: #c0c0c0;">Subscribe Now</a>
                                            @else
                                                <a href="/subscribe-now/{{$plan->id}}" class="btn btn-warning">Subscribe Now</a>
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
        </div>
    </div>



    

</x-app-layout>
