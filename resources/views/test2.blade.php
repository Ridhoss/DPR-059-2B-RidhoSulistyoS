{{-- @extends('layouts.mahasiswa')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger position-absolute top-0 end-0 alert-dismissible fade show" role="alert"">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="/mahasiswa/course" class="btn btn-outline-secondary">Back</a>

    <h3 class="text-center">Mata Kuliah</h3>

    <form action="/mahasiswa/course/add-course" method="post" id="formAddCourse">
        @csrf
        <table class="table table-striped mt-4">
            <thead>
                <tr class="table-primary text-center">
                    <th scope="col">No</th>
                    <th scope="col">Kode Mata Kuliah</th>
                    <th scope="col">Nama Mata Kuliah</th>
                    <th scope="col">Jumlah SKS</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="tableCourse"></tbody>
        </table>
        <div class="position-relative mt-5">
            <button id="btnSave" class="btn btn-success position-absolute bottom-0 end-0" type="button">Save</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        const btnSave = document.getElementById('btnSave');
        const formAddCourse = document.getElementById('formAddCourse');
        btnSave.addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: "Do you want to save the changes?",
                showCancelButton: true,
                confirmButtonText: "Save",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Saved!", "", "success");
                    formAddCourse.submit();
                }
            })
        });
    </script>
    <script>
        let coursesArray = [];
        const tbody = document.getElementById('tableCourse');
        let totalCredits = 0;

        @foreach ($courses as $takes)
            coursesArray.push({
                course_id: "{{ $takes->course_id }}",
                course_code: "{{ $takes->course_code }}",
                course_name: "{{ $takes->course_name }}",
                credits: {{ $takes->credits }}
            });
        @endforeach

        if (coursesArray.length === 0) {
            tbody.innerHTML = /*html*/ `
                    <tr class="text-center">
                        <td colspan="5">Tidak ada data course</td>
                    </tr>
                `;
        } else {
            coursesArray.forEach((course, index) => {
                tbody.innerHTML += /*html*/ `
                        <tr class="text-center">
                            <td>${index + 1}</td>
                            <td>${course.course_code}</td>
                            <td>${course.course_name}</td>
                            <td>${course.credits}</td>
                            <td><input type="checkbox" name="pilih[]" value="${course.course_id}" data-credits="${course.credits}" required></td>
                        </tr>
                    `;
            });

            tbody.innerHTML += /*html*/ `
                <tr class="table-secondary">
                    <td colspan="4" class="text-center fw-bold">Jumlah SKS</td>
                    <td class="text-center fw-bold" id="totalCredits">${totalCredits}</td>
                </tr>
            `;
        }

        const totalCreditsSpan = document.getElementById('totalCredits');

        const checkboxes = document.querySelectorAll('input[name="pilih[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const credits = parseInt(this.getAttribute('data-credits'));

                if (this.checked) {
                    totalCredits += credits;
                } else {
                    totalCredits -= credits;
                }

                totalCreditsSpan.textContent = totalCredits;
            });
        });
    </script>
@endsection --}}
