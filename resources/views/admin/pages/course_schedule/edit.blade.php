<x-admin-app-layout :title="'Course Schedule Update'">
    <div class="card card-flash">
        <div class="card-header">
            <div class="card-title">
            </div>

            <div class="card-toolbar">
                <a href="{{ route('admin.course_schedule.index') }}" class="btn btn-light-primary rounded-2">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5"
                                fill="currentColor" />
                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
                                transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1"
                                fill="currentColor" />
                        </svg>
                    </span> Back to list
                </a>

            </div>
        </div>
        <div class="card-body">

            <form id="myForm" method="post" action="{{ route('admin.course_schedule.update', $item->id) }}"
                enctype="multipart/form-data">
                @csrf

                @method('PUT')

                <div class="card bg-light">

                    <div class="row p-4">

                        <div class="col-4 mb-3">

                            <div class="form-group">
                                <label for="" class="mb-2">Course Name</label>
                                <select name="course_id" data-placeholder="Select Row One.."
                                    class="form-select form-select-sm" data-control="select2"
                                    data-placeholder="Select an option">

                                    @if (count($courses) > 0)
                                        @foreach ($courses as $course)
                                            <option class="form-control" value="{{ $course->id }}"
                                                {{ $item->course_id == $course->id ? 'selected' : '' }}>
                                                {{ $course->name }}
                                            </option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>

                        </div>

                        <div class="col-4 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-2">Venue</label>
                                <input type="text" name="venue" placeholder="Venue Name"
                                    class="form-control form-control-sm" value="{{ $item->venue }}">
                            </div>
                        </div>

                        <div class="col-4 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-2">Country</label>
                                <input type="text" name="country" placeholder="Country Name"
                                    class="form-control form-control-sm" value="{{ $item->country }}">
                            </div>
                        </div>

                        <div class="col-3 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-2">Starting Date</label>
                                <input type="date" name="starting_date" placeholder=""
                                    class="form-control form-control-sm" value="{{ $item->starting_date }}">
                            </div>
                        </div>

                        <div class="col-3 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-2">Duration</label>
                                <input type="text" name="duration" placeholder="6 Month"
                                    class="form-control form-control-sm" value="{{ $item->duration }}">
                            </div>
                        </div>

                        <div class="col-3 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-2">Fee</label>
                                <input type="number" name="fees" placeholder="Eg: 10,525"
                                    class="form-control form-control-sm" value="{{ $item->fees }}">
                            </div>
                        </div>

                        <div class="col-12 mb-3 mt-4">
                            <button type="submit" class="btn btn-primary rounded-0 px-5 btn-sm float-end">Update
                            </button>
                        </div>

                    </div>
                </div>

            </form>

        </div>

    </div>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#myForm').validate({
                    rules: {

                        course_id: {
                            required: true,
                        },

                        title: {
                            required: true,
                        },




                    },
                    messages: {

                        course_id: {
                            required: 'Please Enter Course Name',
                        },

                        title: {
                            required: 'Please Enter Title',
                        },


                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    },
                });
            });
        </script>
    @endpush

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize CKEditor for each textarea with the class 'editor'
            document.querySelectorAll('.editor').forEach(function(textarea) {
                ClassicEditor
                    .create(textarea)
                    .then(editor => {
                        console.log("CKEditor initialized successfully:", editor);
                    })
                    .catch(error => {
                        console.error("CKEditor initialization error:", error);
                    });
            });
        });
    </script>


</x-admin-app-layout>
