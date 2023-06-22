@extends('layouts.master')
@section('title', "all mcq")
@section('content')
        <div class="container">
            <ul class="nav nav-pills mb-3 mt-2" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Reported mcq</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Reported Cq</button>
                </li>
              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                    <h2>সকল রিপোর্টেট এমসি কিউ প্রশ্ন </h2>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Options</th>
                            <th scope="col">Answer</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>my name is shahin alam</td>
                            <td>View delete Edit</td>
                          </tr>
                        </tbody>
                      </table>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                    <h2>সকল রিপোর্টেট সৃজনশীল প্রশ্ন </h2>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Options</th>
                            <th scope="col">Answer</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>my name is shahin alam</td>
                            <td>View delete Edit</td>
                          </tr>
                        </tbody>
                      </table>
                </div>
              </div>
        </div>
@endsection