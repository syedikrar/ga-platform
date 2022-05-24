@extends('layouts.app')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                   <div class="tab-area">
                       <div class="tab-section">
                        <div class="card card-preview d-none">
                            <div class="card-inner">
                                <ul class="nav nav-tabs mt-n3">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabItem1">Climate change</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabItem2">Food sECURITY</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabItem1">
                                        <div id="clock"></div>
                                        <div class="progress-custom">
                                            <div class="fake-class">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar" data-progress="80" style="width: 80%;"> <span>80%</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                                            <div class="timeline-step">
                                                <div class="timeline-content">
                                                    <img src="{{ asset('images/dashboard/time-line-img1.png') }}" alt="">
                                                    <div class="circleBdr">
                                                        <div class="inner-circle">
                                                            <em class="icon ni ni-check"></em>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_content">
                                                        <h6>DAY 1</h6>
                                                        <p>Kick-off
                                                            Worshop</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-step">
                                                <div class="timeline-content">
                                                    <img src="{{ asset('images/dashboard/time-line-img2.png') }}" alt="">
                                                    <div class="circleBdr">
                                                        <div class="inner-circle">
                                                            <em class="icon ni ni-check"></em>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_content">
                                                        <h6>DAY 1</h6>
                                                        <p>Kick-off
                                                            Worshop</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-step">
                                                <div class="timeline-content">
                                                    <img src="{{ asset('images/dashboard/time-line-img3.png') }}" alt="">
                                                    <div class="circleBdr">
                                                        <div class="inner-circle">
                                                            <em class="icon ni ni-check"></em>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_content">
                                                        <h6>DAY 1</h6>
                                                        <p>Kick-off
                                                            Worshop</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-step current">
                                                <div class="timeline-content">
                                                    <img src="{{ asset('images/dashboard/time-line-img4.png') }}" alt="">
                                                    <div class="circleBdr">
                                                        <div class="inner-circle">
                                                            <em class="icon ni ni-check"></em>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_content">
                                                        <h6>DAY 1</h6>
                                                        <p>Kick-off
                                                            Worshop</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-step upNext">
                                                <div class="timeline-content">
                                                    <img src="{{ asset('images/dashboard/time-line-img5.png') }}" alt="">
                                                    <div class="circleBdr">
                                                        <div class="inner-circle">
                                                            <em class="icon ni ni-check"></em>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_content">
                                                        <h6>DAY 1</h6>
                                                        <p>Kick-off
                                                            Worshop</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-step upNext">
                                                <div class="timeline-content">
                                                    <img src="{{ asset('images/dashboard/time-line-img6.png') }}" alt="">
                                                    <div class="circleBdr">
                                                        <div class="inner-circle">
                                                            <em class="icon ni ni-check"></em>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_content">
                                                        <h6>DAY 1</h6>
                                                        <p>Kick-off
                                                            Worshop</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabItem2">
                                        <div id="clock2"></div>
                                        <div class="progress-custom">
                                            <div class="fake-class">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar" data-progress="70" style="width: 70%;"> <span>70%</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                                            <div class="timeline-step">
                                                <div class="timeline-content">
                                                    <img src="{{ asset('images/dashboard/time-line-img1.png') }}"" alt="">
                                                    <div class="circleBdr">
                                                        <div class="inner-circle">
                                                            <em class="icon ni ni-check"></em>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_content">
                                                        <h6>DAY 1</h6>
                                                        <p>Kick-off
                                                            Worshop</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-step">
                                                <div class="timeline-content">
                                                    <img src="{{ asset('images/dashboard/time-line-img2.png') }}" alt="">
                                                    <div class="circleBdr">
                                                        <div class="inner-circle">
                                                            <em class="icon ni ni-check"></em>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_content">
                                                        <h6>DAY 1</h6>
                                                        <p>Kick-off
                                                            Worshop</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-step">
                                                <div class="timeline-content">
                                                    <img src="{{ asset('images/dashboard/time-line-img3.png') }}" alt="">
                                                    <div class="circleBdr">
                                                        <div class="inner-circle">
                                                            <em class="icon ni ni-check"></em>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_content">
                                                        <h6>DAY 1</h6>
                                                        <p>Kick-off
                                                            Worshop</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-step current">
                                                <div class="timeline-content">
                                                    <img src="{{ asset('images/dashboard/time-line-img4.png') }}" alt="">
                                                    <div class="circleBdr">
                                                        <div class="inner-circle">
                                                            <em class="icon ni ni-check"></em>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_content">
                                                        <h6>DAY 1</h6>
                                                        <p>Kick-off
                                                            Worshop</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-step upNext">
                                                <div class="timeline-content">
                                                    <img src="{{ asset('images/dashboard/time-line-img5.png') }}" alt="">
                                                    <div class="circleBdr">
                                                        <div class="inner-circle">
                                                            <em class="icon ni ni-check"></em>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_content">
                                                        <h6>DAY 1</h6>
                                                        <p>Kick-off
                                                            Worshop</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-step upNext">
                                                <div class="timeline-content">
                                                    <img src="{{ asset('images/dashboard/time-line-img6.png') }}" alt="">
                                                    <div class="circleBdr">
                                                        <div class="inner-circle">
                                                            <em class="icon ni ni-check"></em>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_content">
                                                        <h6>DAY 1</h6>
                                                        <p>Kick-off
                                                            Worshop</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- tab bottom -->
                                <div class="tab-bottom">
                                    <ul class="nav nav-tabs mt-n3">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tabItem3"><em class="icon ni ni-file-docs"></em> My TASKS <span class="activeDot"></span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabItem4"><em class="icon ni ni-alert"></em> Risks <span class="activeDot"></span></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tabItem3">
                                           <div class="table-content">
                                            <table class="table">
                                                <thead>
                                                  <tr>
                                                    <th scope="col">Priority:</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">PRIORITY</th>
                                                    <th scope="col">DEADLINE</th>
                                                    <th scope="col">DEADLINE</th>
                                                    <th scope="col">Progress</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <td class="td1" scope="row">Discussing the current flow and the available improvement options</td>
                                                    <td>In progress</td>
                                                    <td><span class="urgent"></span>
                                                        <span class="badge badge-dim badge-danger"><span>Urgent</span></span>
                                                    </td>
                                                    <td>12 Nov 2022</td>
                                                    <td>12 Nov 2022</td>
                                                    <td class="progress_">
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-amount">80</div>
                                                                <span class="percent_">%</span>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                <div class="progress-bar" data-progress="80" style="width: 80%;"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td class="td1 active" scope="row">Discussing the current flow and the available improvement options</td>
                                                    <td>In progress</td>
                                                    <td><span class="urgent"></span>
                                                        <span class="badge badge-dim badge-danger"><span>Urgent</span></span>
                                                    </td>
                                                    <td>12 Nov 2022</td>
                                                    <td>12 Nov 2022</td>
                                                    <td class="progress_">
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-amount">40</div>
                                                                <span class="percent_">%</span>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                <div class="progress-bar" data-progress="40" style="width: 40%;"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td class="td1" scope="row">Discussing the current flow and the available improvement options</td>
                                                    <td>In progress</td>
                                                    <td><span class="urgent"></span>
                                                        <span class="badge badge-dim badge-danger"><span>Urgent</span></span>
                                                    </td>
                                                    <td>12 Nov 2022</td>
                                                    <td>12 Nov 2022</td>
                                                    <td class="progress_">
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-amount">100</div>
                                                                <span class="percent_">%</span>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                <div class="progress-bar" data-progress="100" style="width: 100%;"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                           </div>
                                        </div>
                                        <div class="tab-pane" id="tabItem4">
                                            <div class="table-content">
                                                <table class="table">
                                                    <thead>
                                                      <tr>
                                                        <th scope="col">Priority:</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">PRIORITY</th>
                                                        <th scope="col">DEADLINE</th>
                                                        <th scope="col">DEADLINE</th>
                                                        <th scope="col">Progress</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        <td class="td1" scope="row">Discussing the current flow and the available improvement options</td>
                                                        <td>In progress</td>
                                                        <td><span class="urgent"></span>
                                                            <span class="badge badge-dim badge-danger"><span>Urgent</span></span>
                                                        </td>
                                                        <td>12 Nov 2022</td>
                                                        <td>12 Nov 2022</td>
                                                        <td class="progress_">
                                                            <div class="progress-wrap">
                                                                <div class="progress-text">
                                                                    <div class="progress-amount">80</div>
                                                                    <span class="percent_">%</span>
                                                                </div>
                                                                <div class="progress progress-md">
                                                                    <div class="progress-bar" data-progress="80" style="width: 80%;"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td class="td1 active" scope="row">Discussing the current flow and the available improvement options</td>
                                                        <td>In progress</td>
                                                        <td><span class="urgent"></span>
                                                            <span class="badge badge-dim badge-danger"><span>Urgent</span></span>
                                                        </td>
                                                        <td>12 Nov 2022</td>
                                                        <td>12 Nov 2022</td>
                                                        <td class="progress_">
                                                            <div class="progress-wrap">
                                                                <div class="progress-text">
                                                                    <div class="progress-amount">40</div>
                                                                    <span class="percent_">%</span>
                                                                </div>
                                                                <div class="progress progress-md">
                                                                    <div class="progress-bar" data-progress="40" style="width: 40%;"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td class="td1" scope="row">Discussing the current flow and the available improvement options</td>
                                                        <td>In progress</td>
                                                        <td><span class="urgent"></span>
                                                            <span class="badge badge-dim badge-danger"><span>Urgent</span></span>
                                                        </td>
                                                        <td>12 Nov 2022</td>
                                                        <td>12 Nov 2022</td>
                                                        <td class="progress_">
                                                            <div class="progress-wrap">
                                                                <div class="progress-text">
                                                                    <div class="progress-amount">100</div>
                                                                    <span class="percent_">%</span>
                                                                </div>
                                                                <div class="progress progress-md">
                                                                    <div class="progress-bar" data-progress="100" style="width: 100%;"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                               </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end tab 2 -->
                            </div>
                        </div><!-- .card-preview -->
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
