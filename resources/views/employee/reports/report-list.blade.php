@extends('employee.layouts.app')
@section('content')
    <style>

        .data_head_container {
            display: flex;
            gap: 12px;
            flex-direction: column;
        }

        .data_head_container a {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .data_head_container .profile_container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .data_head_container .profile_owner {
            color: #6a6a6a;
        }
    </style>
    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>İşçi hesabatları</h3>
                        <a href="{{ route('employee.reports.index') }}">
                            <button class="btn btn-danger">
                                <span class="me-2">
                                    <i class="nav-icon i-Arrow-Back-2"></i>
                                </span>
                                Öz hesabatlarım
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionRightIcon">

                        @foreach($report_user_list as $report_user)
                            @foreach($report_user->reports as $report)
                                <div class="card p-8">
                                    <div class="card-header header-elements-inline">
                                        <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0 data_head_container">
                                            <div class="profile_container">
                                                <div class="profile_img">
                                                    @if(!is_null($report_user->avatar))
                                                        <img
                                                            src="{{ asset('assets/images/avatars').'/'.$report_user->avatar }}"
                                                            height="26px" alt="">
                                                    @else
                                                        <i class="nav-icon i-Checked-User" style="font-size: 26px;"></i>
                                                    @endif
                                                </div>
                                                <div class="profile_owner">{{ $report_user->name }}</div>
                                            </div>

                                            <a data-toggle="collapse" class="text-default collapsed"
                                               href="#accordion-item-icons-{{ $report->id }}" aria-expanded="false">
                                                <span><i class="i-Data-Settings ul-accordion__font"> </i></span>
                                                {{ \Carbon\Carbon::parse($report->report_date)->format('d.m.Y') }}
                                                tarixi üçün həftəlik hesabat <strong
                                                    class="text-{{$report->status == 2 ? 'success' : 'primary'}}">({{ $report->status==2 ? 'Hesabatı təsdiq etdiniz' : 'Təsdiq üçün göndərildi' }}
                                                    )</strong></a>
                                        </h6>

                                    </div>


                                    <div id="accordion-item-icons-{{ $report->id }}" class="collapse"
                                         data-parent="#accordionRightIcon"
                                         style="">
                                        <div class="card-body">
                                            <ul class="list-group">
                                                @foreach($report->reports_subjects as $subject_key => $subject)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <p class="text-primary">{{ $subject_key+1 }}
                                                            . {{ $subject->subject }}</p>
                                                        <strong>{{ $subject->project_name }}</strong>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        @if($report->status == 1)
                                            <div class="card-footer">
                                                <button class="btn btn-success accept-report" data-type="accept" type="button"
                                                        data-report-id="{{ $report->id }}">
                                                    Hesabatı təsdiq edin
                                                </button>
                                            </div>
                                        @elseif($report->status == 2)
                                            <div class="card-footer">
                                                <button class="btn btn-danger accept-report"  data-type="reject" type="button"
                                                        data-report-id="{{ $report->id }}">
                                                    Geri göndərin
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection
@section('js')
    <script>

        $(document).ready(function () {

            let rowCount = 0;

            addNewBtn.addEventListener('click', function () {
                rowCount++;
                const formsContainer = document.querySelector('.form_inputs_container');
                const defaultForm = document.getElementById('formRow');

                const clone = defaultForm.cloneNode(true);
                clone.id += rowCount;
                const inputs = clone.querySelectorAll('input');
                const selects = clone.querySelectorAll('select');
                const error_messages = clone.querySelectorAll('.error_message');
                const delete_button = clone.querySelectorAll('.delete_block');

                inputs.forEach((input) => {
                    const $input = $(input);
                    const $textDiv = $input.siblings('div.text');
                    $textDiv.empty();
                    input.value = '';
                    input.id ? input.id += rowCount : null;
                });

                selects.forEach((select) => {
                    const $select = $(select);
                    $select.find(":selected").val('');
                    const $textDiv = $select.siblings('div.text');
                    $textDiv.empty();
                    if (select.id) {
                        select.id += rowCount;
                    }
                });

                error_messages.forEach(message => message.id ? message.id += rowCount : null);

                delete_button.forEach(button => button.id ? button.id += rowCount : null);

                formsContainer.appendChild(clone);

                const dynamicForm = document.getElementById(`formRow${rowCount}`);
                if (rowCount > 0) {
                    const deleteContainer = document.createElement('div');
                    deleteContainer.id = `delete_container${rowCount}`;
                    deleteContainer.classList.add('delete_block');
                    deleteContainer.textContent = 'Bloku sil';
                    dynamicForm.appendChild(deleteContainer);
                }
                ;


                $('.ui.create_form_dropdown').dropdown({
                    clearable: true,
                });

                $('.vendors_select_cl').dropdown({
                    allowAdditions: true,
                    clearable: true,
                });
            });

        })


        $(document).on('click', '[id^="delete_container"]', function (e) {
            const number = e.target.id.substring(16, e.target.id.length);
            const container = document.querySelector(`#formRow${number}`);
            container.remove();
            rowCount--;
            fields = fields.filter(field => field.num != number)
            console.log(fields)
        });

        $('#categories_id').on("change", function (e) {
            const main_categories_id = e.target.value;
            $.ajax({
                url: "{{ url('employee/reports-subcategories-by-main-category') }}",
                type: "POST",
                data: {
                    "_token": "{{csrf_token()}}",
                    "categories_id": main_categories_id
                },
                success: function (response) {
                    let subcategory = $('#subcategories_id');
                    subcategory.empty();
                    $.each(response, function (index, category) {
                        subcategory.append($("<option>", {
                            value: category.id,
                            text: category.name
                        }));
                    });
                    subcategory.attr('disabled', false);
                }
            })
        })

        $('.accept-report').on("click", function (e) {
            const report_id = $(this).data('report-id');
            const type = $(this).data('type');
            $.ajax({
                url: "{{ route('employee.update-report-status') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "report_id": report_id,
                    "type": type
                },
                success: function (response) {
                    Swal.fire({
                        icon: response.icon,
                        title: response.message
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = response.route;
                        }
                    });
                }
            })
        })

    </script>
@endsection
