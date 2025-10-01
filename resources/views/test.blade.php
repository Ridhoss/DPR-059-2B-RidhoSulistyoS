@section('script')
    {{-- <script>
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
    </script> --}}

        {{-- <script>
        let coursesArray = [];
        const tbody = document.getElementById('tableCourse');
        const formDelete = document.getElementById('formDeleteCourse');
        const inputCourseId = document.getElementById('deleteCourseId');

        @foreach ($courses as $takes)
            coursesArray.push({
                course_id: "{{ $takes->course_id }}",
                course_code: "{{ $takes->course_code }}",
                course_name: "{{ $takes->course_name }}",
                credits: {{ $takes->credits }}
            });
        @endforeach

        // fetch('http://10.10.131.208:8000/test')
        //     .then(response => response.json())
        //     .then(data => {
        //         courses = data;

        //         courses.forEach((course, index) => {
        //             tbody.innerHTML += /* html */ `
    //             <tr class="text-center">
    //                 <td>${index + 1}</td>
    //                 <td>${course.course_code}</td>
    //                 <td>${course.course_name}</td>
    //                 <td>${course.credits}</td>
    //                 <td>
    //                     <button class="btn btn-warning">Edit</button>
    //                     <button class="btn btn-danger">Delete</button>
    //                 </td>
    //             </tr>
    //         `;
        //         });
        //     })
        //     .catch(error => console.error('Error:', error));

        // const courses = @json($courses);

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
                            <td>
                                <a href="course/edit-course/${course.course_id}" class="btn btn-warning text-white">Edit</a>
                                <button class="btn btn-danger btn-delete" data-delete='${JSON.stringify(course)}'>Delete</button>
                            </td>
                        </tr>
                    `;
            });

            const btnDelete = document.querySelectorAll('.btn-delete');
            btnDelete.forEach(del => {
                del.addEventListener('click', function() {
                    const courseData = this.getAttribute('data-delete');
                    const course = JSON.parse(courseData);

                    Swal.fire({
                        title: "Do you want to delete this data?",
                        text: "Course: " + course.course_name + " (" + course.course_code + ")",
                        showCancelButton: true,
                        confirmButtonText: "Delete",
                        cancelButtonText: "Cancel",
                        confirmButtonColor: "#d33",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            inputCourseId.value = course.course_id;
                            formDelete.submit();
                        }
                    });
                });
            });
        }
    </script> --}}
@endsection
