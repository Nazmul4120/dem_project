<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Hi... <b> {{ Auth::user()->name}} </b>
            <b style="float:right;">Total User
                <span class="badge badge-danger"> {{ count($users) }} </span>

            </b>


        </h2>
    </x-slot>
  <div class="py-12">

        <div class="container" >
            <div class= "row" >

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="SL NO">#</th>
                        <th scope="Name">First</th>
                        <th scope="Email">Last</th>
                        <th scope="Created At">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                     @php($i=1)

                    @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at->diffForHumans()}} </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
  </div>



</x-app-layout>
