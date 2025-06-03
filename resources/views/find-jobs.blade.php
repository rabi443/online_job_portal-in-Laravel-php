<x-header-footer>
    <section class="section-3 py-5 bg-2 ">

        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Find Jobs</h2>  
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <select name="sort" id="sort" class="form-control">
                            <option value="latest">Latest</option>
                            <option value="oldest">Oldest</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // AJAX request to fetch job titles when user starts typing
        $('#job_title').on('keyup', function () {
            let searchTerm = $(this).val();
            if (searchTerm.length >= 3) {  // Trigger AJAX when user types 3 or more characters
                $.ajax({
                    url: "{{ route('search.job_titles') }}",  // Route to get job titles
                    type: 'GET',
                    data: { search: searchTerm },
                    success: function (response) {
                        $('#job_titles_list').empty();  // Clear previous results
                        response.jobTitles.forEach(function (title) {
                            $('#job_titles_list').append('<li class="list-group-item">' + title.name + '</li>');
                        });
                    }
                });
            }
        });

        // Optional: Handle click on job title
        $(document).on('click', '#job_titles_list li', function () {
            $('#job_title').val($(this).text()); // Populate the input with selected job title
            $('#job_titles_list').empty();  // Clear the list after selection
        });
    });
</script>

</x-header-footer>
