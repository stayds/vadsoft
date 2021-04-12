<div class="table-responsive">
    <table class="table table-bordered mb-4">
        <tbody>
            <tr>
                <td class="description text-uppercase font-weight-bold">Full Name</td>
                <td>{{$staff->fname}} {{$staff->lname}}</td>
            </tr>
            <tr>
                <td class="description text-uppercase font-weight-bold">Phone</td>
                <td>{{$staff->phone}}</td>
            </tr>
            <tr>
                <td class="description text-uppercase font-weight-bold">Email</td>
                <td>{{$staff->email}}</td>
            </tr>
            <tr>
                <td class="description text-uppercase font-weight-bold">Staff No.</td>
                <td>{{$staff->staffno}}</td>
            </tr>
            <tr>
                <td class="description text-uppercase font-weight-bold">grade level</td>
                <td>{{$staff->gradelevel}}</td>
            </tr>
            <tr>
                <td class="description text-uppercase font-weight-bold">Job title</td>
                <td>{{$staff->jobtitle}}</td>
            </tr>
            <tr>
                <td class="description text-uppercase font-weight-bold">Department</td>
                <td>{{$staff->dept}}</td>
            </tr>
            <tr>
                <td class="description text-uppercase font-weight-bold">State</td>
                <td>{{$staff->state}}</td>
            </tr>
    </table>
</div>
