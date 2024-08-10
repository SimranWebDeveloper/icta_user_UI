@extends('hr.layouts.app')
@section('content')

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;


    }

    .employeeAnswerModal .swal2-popup {
        width: 80%;
    }

    #list-item {
        list-style: none;
    }

    .custom-container {
        /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
        background-color: transparent;
    }

    .custom-container .col-12 .surveys-name {
        border: 1px solid #C7C8CC;
    }

    .question-blank {}

    .checkbox-wrapper {
        width: 17%;
    }

    .answers ul li {
        gap: 30px;
    }

    .checkbox-wrapper input {
        width: 40px;
        height: 40px;
        border: 1px solid #C7C8CC;

    }

    .label-wrapper {
        border: 1px solid #C7C8CC;
    }

    .label-wrapper label {
        height: 37px;
        /* width: 300px; */
    }

    textarea {
        resize: none;
    }
</style>

<div class="pt-4 custom-container bg-white">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <ul class="m-0 p-0">
                                <li id="list-item">
                                    @if ($survey->status == 0)
                                        <button class="btn btn-danger text-white">
                                            Deaktiv
                                        </button>
                                    @elseif ($survey->status == 1)
                                        <button class="btn btn-success text-white">
                                            Aktiv
                                        </button>
                                    @elseif ($survey->status == 2)
                                        <button class="btn btn-warning text-white">
                                            Gözləmə
                                        </button>
                                    @endif
                                </li>
                            </ul>
                            <h3 class="ml-3 mt-0 mb-0 mr-0">{{ $survey->name }}</h3>
                        </div>
                        <a href="{{route('hr.surveys.index')}}">
                            <button class="btn btn-danger">
                                <span class="me-2">
                                    <i class="nav-icon i-Arrow-Back-2"></i>
                                </span>
                                Anketler
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($survey->surveys_questions as $question)
                            <div class="col-md-6 col-sm-12">
                                <div class="card mb-4">
                                    <div class="card-header w-100 d-flex justify-content-center align-items-center">
                                        <h3 class="m-0">{{ $loop->iteration }}.</h3>
                                        <h3 class="m-0">{{ $question->question }}</h3>
                                    </div>
                                    <div class="card-body">
                                        @if($question->input_type == 'checkbox')
                                            <ul class="list-group-custom">
                                                @foreach($question->answers as $answer)
                                                    <li class="d-flex my-3 align-items-center w-100 justify-content-between">
                                                        <div class="checkbox-wrapper d-flex">
                                                            <!-- <input type="checkbox" disabled> -->
                                                            <!-- <i class="fa-light fa-square-check "                           style="color: #000000;"></i> -->
                                                            <!-- <i class="fa-duotone fa-solid fa-square-check text-50"></i> -->
                                                            <i class="fa-thin fa-square-check"
                                                                style='font-size: 40px; color:#C7C8CC'></i>
                                                            <!-- <i class="fa-thin fa-square-check text-50" style="color: #000000;"></i> -->
                                                        </div>
                                                        <div class="label-wrapper w-100 text-center"
                                                            style="border-radius: 2.25rem;">
                                                            <label class="d-flex justify-content-center align-items-center">
                                                                {{ $answer->name }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @elseif($question->input_type == 'radio')
                                            <ul class="list-group-custom">
                                                @foreach($question->answers as $answer)
                                                    <li class="d-flex my-3 align-items-center w-100 justify-content-between">
                                                        <div class="checkbox-wrapper d-flex">
                                                            <i class="fa-sharp fa-thin fa-circle-dot"
                                                                style='font-size: 40px; color:#C7C8CC'></i>
                                                            <!-- <i class="fa-sharp-duotone fa-solid fa-circle-dot text-50"></i> -->
                                                            <!-- <input type="radio" disabled name="question_{{ $question->id }}"> -->
                                                        </div>
                                                        <div class="label-wrapper w-100 text-center"
                                                            style="border-radius: 2.25rem;">
                                                            <label class="d-flex justify-content-center align-items-center">
                                                                {{ $answer->name }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @elseif($question->input_type == 'textarea')
                                            <div class="form-floating">
                                                <textarea rows="7" cols="10" class="form-control" disabled></textarea>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>İştirakçılar</h3>
                                </div>
                                <div class="card-body">
                                    @php
                                        $groupedParticipants = $users->groupBy(function ($user) {
                                            return $user->departments_id . '-' . $user->branches_id;
                                        });
                                    @endphp

                                    @foreach($groupedParticipants as $group => $users)
                                        <div class="d-xl-flex mt-3 align-items-start">
                                            <h3 class="col-xl-2 m-0">
                                                {{ $departments[$users->first()->departments_id] ?? 'Bilinməyən departament' }}
                                            </h3>

                                            <h4 class="col-xl-2 mb-0 mt-2 mt-xl-0">
                                                {{ $branches[$users->first()->branches_id] ?? 'Bilinməyən şöbə' }}
                                            </h4>

                                            <div class="col-xl-8 d-flex align-items-start flex-wrap mt-2 mb-0 mt-xl-0">
                                                @foreach($users as $index => $user)
                                                    <h5 style="cursor: pointer" class="mt-1 mb-1 mt-xl-0 mb-xl-0"
                                                        id="employeeAnswer">{{ $user->name }}
                                                    </h5>
                                                    {{ $index < count($users) - 1 ? ', ' : '' }}
                                                @endforeach
                                            </div>
                                        </div>
                                        @if (!$loop->last)
                                            <hr class="hr" />
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{route('hr.surveys.edit', $survey->id)}}">
                        <button class="btn btn-info btn-lg">
                            <span class="me-2 ">
                                <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                            </span>
                            Düzəliş et
                        </button>
                    </a>
                    <a href="#" class="delete-item" data-id="{{ $survey->id }}">
                        <button class="btn btn-danger btn-lg">
                            <span class="me-2">
                                <ion-icon name="trash-outline"></ion-icon>
                            </span>
                            Sil
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('.delete-item').on("click", function () {
            const item_id = $(this).data('id');
            Swal.fire({
                title: "Silmək istədiyinizdən əminsiniz ?",
                text: "Qeyd edək ki, silmək istədiyiniz elemendə bağlı olan bütün məlumatlar silinəcək!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sil!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/hr/surveys/" + item_id,
                        type: "DELETE",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            Swal.fire(response.message).then((result) => {
                                if (result.isConfirmed) {
                                    location.href = response.route;
                                }
                            });
                        },
                    })
                }
            })
        })





        $("#employeeAnswer").on("click", function () {
            Swal.fire({
                title: 'Istifadeci cavablari',
                html: `
                    <div class="row mb-4 w-100">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <!-- checkbox -->
                    <div class="col-lg-6 col-12">                        
                        <div class="card mb-4">
                            <div class="card-header w-100 d-flex justify-content-center align-items-center">
                                <h3 class="m-0">1.</h3>
                                <h3 class="m-0">cox variantli</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group-custom">

                                    <li class="d-flex my-3 align-items-center w-100 justify-content-between">
                                       <div class="d-flex align-items-center justify-content-between  w-100 py-2">
                                            <div class="d-flex align-items-center justify-content-center">                                                
                                                <input type="checkbox" disabled checked class=" rounded" style="width: 35px; height: 35px" />
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center  w-100 pl-3">
                                                <label class="text-justify">
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                </label>
                                            </div>
                                       </div>
                                    </li>
                                    <li class="d-flex my-3 align-items-center w-100 justify-content-between">
                                       <div class="d-flex align-items-center justify-content-between  w-100 py-2">
                                            <div class="d-flex align-items-center justify-content-center">                                                
                                                <input type="checkbox" disabled  class=" rounded" style="width: 35px; height: 35px" />
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center  w-100 pl-3">
                                                <label class="text-justify">
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                </label>
                                            </div>
                                       </div>
                                    </li>                              

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- radio -->
                    <div class="col-lg-6 col-12">                        
                        <div class="card mb-4">
                            <div class="card-header w-100 d-flex justify-content-center align-items-center">
                                <h3 class="m-0">2.</h3>
                                <h3 class="m-0">Tek variantli</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group-custom">

                                    <li class="d-flex my-3 align-items-center w-100 justify-content-between">
                                       <div class="d-flex align-items-center justify-content-between  w-100 py-2">
                                            <div class="d-flex align-items-center justify-content-center">                                                
                                                <input type="radio" disabled checked name="radio_name" class=" rounded" style="width: 35px; height: 35px" />
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center  w-100 pl-3">
                                                <label class="text-justify">
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                </label>
                                            </div>
                                       </div>
                                    </li>
                                    <li class="d-flex my-3 align-items-center w-100 justify-content-between">
                                       <div class="d-flex align-items-center justify-content-between  w-100 py-2">
                                            <div class="d-flex align-items-center justify-content-center">                                                
                                                <input type="radio" disabled name="radio_name" class=" rounded" style="width: 35px; height: 35px" />
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center  w-100 pl-3">
                                                <label class="text-justify">
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                </label>
                                            </div>
                                       </div>
                                    </li>                              

                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- text -->
                    <div class="col-lg-6 col-12">                        
                        <div class="card mb-4">
                            <div class="card-header w-100 d-flex justify-content-center align-items-center">
                                <h3 class="m-0">2.</h3>
                                <h3 class="m-0">Metn</h3>
                            </div>
                            <div class="card-body">
                                <ul class="w-100  pl-0">

                                    <li class=" d-flex my-3 align-items-center w-100 justify-content-between ">
                                       <div class="d-flex align-items-center justify-content-between  w-100 ">
                                            
                                                <textarea  rows="7" cols="10" class="w-100 " disabled="" style="resize: none;"></textarea>

                                       </div>
                                    </li>
                                                  

                                </ul>
                            </div>
                        </div>
                    </div>


                </div>


            </div>


        </div>
    </div>
</div>
                `,showConfirmButton: true,
                customClass: {
                    popup: 'swal2-popup', // Ensures that only this modal has the specific width
                    container: 'employeeAnswerModal' // Custom class to differentiate this modal
                }
            });

        });


    })
</script>
@endsection




















