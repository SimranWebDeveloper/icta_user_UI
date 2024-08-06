@extends('admin.layouts.app')

@section('content')

    <style>
        .message {
            padding: 10px;
            margin: 5px 0;
            border-radius: 10px;
            max-width: 70%;
        }

        #chatMessages{
            display: flex;
            flex-direction: column;
        }

        .sent {
            background-color: #dcf8c6;
            align-self: flex-end;
        }
        .received {
            background-color: #ffffff;
            align-self: flex-start;
        }
    </style>

    <div class="main-content">
        <div data-sidebar-container="chat" class="card chat-sidebar-container sidebar-container">
            <div data-sidebar="chat" class="chat-sidebar-wrap sidebar" style="left: 0px;">
                <div class="border-right">
                    <div class="pt-2 pb-2 pl-3 pr-3 d-flex align-items-center o-hidden box-shadow-1 chat-topbar">
                        <a data-sidebar-toggle="chat" class="link-icon d-md-none">
                            <i class="icon-regular ml-0 mr-3 i-Left"></i>
                        </a>
                        <div class="form-group m-0 flex-grow-1">
                            <input type="text" class="form-control form-control-rounded" id="search"
                                   placeholder="Search contacts">
                        </div>
                    </div>

                    <div class="contacts-scrollable perfect-scrollbar ps ims-users">
                        @foreach ($users as $user)
                            <div class="p-3 d-flex border-bottom align-items-center {{ isUserActive($user->id) ? 'online' : 'offline' }} online clearfix fore-user"
                                 data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">
                                <img src="https://gull-html-laravel.ui-lib.com/assets/images/faces/3.jpg" alt=""
                                     class="avatar-sm rounded-circle mr-3">
                                <h6 class="">{{ $user->name }}</h6>
                            </div>
                        @endforeach
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div data-sidebar-content="chat" class="chat-content-wrap sidebar-content" style="margin-left: 260px;">
                <div class="d-flex pl-3 pr-3 pt-2 pb-2 o-hidden box-shadow-1 chat-topbar">
                    <a data-sidebar-toggle="chat" class="link-icon d-md-none">
                        <i class="icon-regular i-Right ml-0 mr-3"></i>
                    </a>
                    <div class="d-flex align-items-center">
                        <img src="https://gull-html-laravel.ui-lib.com/assets/images/faces/13.jpg" alt=""
                             class="avatar-sm rounded-circle mr-2">
                        <p class="m-0 text-title text-16 flex-grow-1 chat-with" id="chatUserName"></p>
                    </div>
                </div>

                <div class="chat-content perfect-scrollbar ps" data-suppress-scroll-x="true" id="chatMessages">
                    <audio id="notificationSound" src="{{ asset('sounds/ims-notification.mp3') }}" preload="auto"></audio>
                </div>

                <div class="pl-3 pr-3 pt-3 pb-3 box-shadow-1 chat-input-area">
                    <form id="sendMessageForm" action="{{ route('admin.messages.send') }}" method="POST">
                        @csrf
                        <input type="hidden" id="to_user_id" name="to_user_id">
                        <div class="input-group">
                            <input type="text" id="message" name="message" class="form-control form-control-rounded" placeholder="Mesajınızı daxil edin">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Göndər</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

