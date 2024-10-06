 @extends('layouts.account')

 @section('content')
 <div class="container">
     <br>
     <h2 class="text-center">Edit Job Post</h2>

     @if(session('success'))
     <div class="alert alert-success">
         {{ session('success') }}
     </div>
     @endif

     <form action="{{ route('author.post.update', $post->id) }}" method="POST">
         @csrf
         @method('PUT')

         <div class="form-group mb-3">
             <label for="company_id" class="form-label text-primary">Company</label>
             <select name="company_id" id="company_id" class="form-control bg-light text-dark border-primary" required>
                 @foreach($companies as $company)
                 <option value="{{ $company->id }}" {{ $post->company_id == $company->id ? 'selected' : '' }}>
                     {{ $company->title }}
                 </option>
                 @endforeach
             </select>
         </div>

         <div class="mb-3">
             <label for="job_title" class="form-label">Job Title</label>
             <input type="text" class="form-control" name="job_title" id="job_title" value="{{ $post->job_title }}" required>
         </div>

         <div class="mb-3">
             <label for="job_level" class="form-label">Job Level</label>
             <select name="job_level" class="form-control" id="job_level" required>
                 <option value="" disabled {{ is_null($post->job_level) ? 'selected' : '' }}>Select Job Level</option>
                 <option value="entry" {{ $post->job_level == 'entry' ? 'selected' : '' }}>Entry Level</option>
                 <option value="mid" {{ $post->job_level == 'mid' ? 'selected' : '' }}>Mid Level</option>
                 <option value="senior" {{ $post->job_level == 'senior' ? 'selected' : '' }}>Senior Level</option>
                 <option value="manager" {{ $post->job_level == 'manager' ? 'selected' : '' }}>Manager Level</option>
                 <option value="executive" {{ $post->job_level == 'executive' ? 'selected' : '' }}>Executive Level</option>
                 <option value="other" {{ $post->job_level == 'other' ? 'selected' : '' }}>Other</option>
             </select>
         </div>

         <div class="mb-3">
             <label for="vacancy_count" class="form-label">Vacancy Count</label>
             <input type="number" class="form-control" name="vacancy_count" id="vacancy_count" value="{{ $post->vacancy_count }}" min="0" required>
         </div>


         <div class="mb-3">
             <label for="employment_type" class="form-label">Employment Type</label>
             <select name="employment_type" class="form-control" id="employment_type" required>
                 <option value="" disabled {{ is_null($post->employment_type) ? 'selected' : '' }}>Select Employment Type</option>
                 <option value="Full-Time" {{ $post->employment_type == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                 <option value="Part-Time" {{ $post->employment_type == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                 <option value="Contract" {{ $post->employment_type == 'Contract' ? 'selected' : '' }}>Contract</option>
                 <option value="Internship" {{ $post->employment_type == 'Internship' ? 'selected' : '' }}>Internship</option>
                 <option value="Freelance" {{ $post->employment_type == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                 <option value="Temporary" {{ $post->employment_type == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                 <option value="Remote" {{ $post->employment_type == 'Remote' ? 'selected' : '' }}>Remote</option>
             </select>
         </div>


         <div class="mb-3">
             <label for="salary" class="form-label">Salary</label>
             <input type="number" class="form-control" name="salary" id="salary" value="{{ $post->salary }}" required>
         </div>

         <div class="mb-3">
             <label for="job_location" class="form-label">Job Location</label>
             <select name="job_location" class="form-control" id="job_location" required>
                 <option value="" disabled {{ is_null($post->job_location) ? 'selected' : '' }}>Select Job Location</option>
                 <option value="Achham" {{ $post->job_location == 'Achham' ? 'selected' : '' }}>Achham</option>
                 <option value="Arghakhanchi" {{ $post->job_location == 'Arghakhanchi' ? 'selected' : '' }}>Arghakhanchi</option>
                 <option value="Baglung" {{ $post->job_location == 'Baglung' ? 'selected' : '' }}>Baglung</option>
                 <option value="Baitadi" {{ $post->job_location == 'Baitadi' ? 'selected' : '' }}>Baitadi</option>
                 <option value="Bajhang" {{ $post->job_location == 'Bajhang' ? 'selected' : '' }}>Bajhang</option>
                 <option value="Bajura" {{ $post->job_location == 'Bajura' ? 'selected' : '' }}>Bajura</option>
                 <option value="Banepa" {{ $post->job_location == 'Banepa' ? 'selected' : '' }}>Banepa</option>
                 <option value="Bhaktapur" {{ $post->job_location == 'Bhaktapur' ? 'selected' : '' }}>Bhaktapur</option>
                 <option value="Bhimdatta" {{ $post->job_location == 'Bhimdatta' ? 'selected' : '' }}>Bhimdatta</option>
                 <option value="Chitwan" {{ $post->job_location == 'Chitwan' ? 'selected' : '' }}>Chitwan</option>
                 <option value="Dang" {{ $post->job_location == 'Dang' ? 'selected' : '' }}>Dang</option>
                 <option value="Dhanusa" {{ $post->job_location == 'Dhanusa' ? 'selected' : '' }}>Dhanusa</option>
                 <option value="Dolakha" {{ $post->job_location == 'Dolakha' ? 'selected' : '' }}>Dolakha</option>
                 <option value="Dolpa" {{ $post->job_location == 'Dolpa' ? 'selected' : '' }}>Dolpa</option>
                 <option value="Gorkha" {{ $post->job_location == 'Gorkha' ? 'selected' : '' }}>Gorkha</option>
                 <option value="Humla" {{ $post->job_location == 'Humla' ? 'selected' : '' }}>Humla</option>
                 <option value="Ilam" {{ $post->job_location == 'Ilam' ? 'selected' : '' }}>Ilam</option>
                 <option value="Jajarkot" {{ $post->job_location == 'Jajarkot' ? 'selected' : '' }}>Jajarkot</option>
                 <option value="Jumla" {{ $post->job_location == 'Jumla' ? 'selected' : '' }}>Jumla</option>
                 <option value="Kailali" {{ $post->job_location == 'Kailali' ? 'selected' : '' }}>Kailali</option>
                 <option value="Kaski" {{ $post->job_location == 'Kaski' ? 'selected' : '' }}>Kaski</option>
                 <option value="Kathmandu" {{ $post->job_location == 'Kathmandu' ? 'selected' : '' }}>Kathmandu</option>
                 <option value="Kavrepalanchok" {{ $post->job_location == 'Kavrepalanchok' ? 'selected' : '' }}>Kavrepalanchok</option>
                 <option value="Lalitpur" {{ $post->job_location == 'Lalitpur' ? 'selected' : '' }}>Lalitpur</option>
                 <option value="Makwanpur" {{ $post->job_location == 'Makwanpur' ? 'selected' : '' }}>Makwanpur</option>
                 <option value="Manang" {{ $post->job_location == 'Manang' ? 'selected' : '' }}>Manang</option>
                 <option value="Mugu" {{ $post->job_location == 'Mugu' ? 'selected' : '' }}>Mugu</option>
                 <option value="Myagdi" {{ $post->job_location == 'Myagdi' ? 'selected' : '' }}>Myagdi</option>
                 <option value="Nawalpur" {{ $post->job_location == 'Nawalpur' ? 'selected' : '' }}>Nawalpur</option>
                 <option value="Nuwakot" {{ $post->job_location == 'Nuwakot' ? 'selected' : '' }}>Nuwakot</option>
                 <option value="Okhaldhunga" {{ $post->job_location == 'Okhaldhunga' ? 'selected' : '' }}>Okhaldhunga</option>
                 <option value="Palpa" {{ $post->job_location == 'Palpa' ? 'selected' : '' }}>Palpa</option>
                 <option value="Panchthar" {{ $post->job_location == 'Panchthar' ? 'selected' : '' }}>Panchthar</option>
                 <option value="Parbat" {{ $post->job_location == 'Parbat' ? 'selected' : '' }}>Parbat</option>
                 <option value="Patan" {{ $post->job_location == 'Patan' ? 'selected' : '' }}>Patan</option>
                 <option value="Pyuthan" {{ $post->job_location == 'Pyuthan' ? 'selected' : '' }}>Pyuthan</option>
                 <option value="Ramechhap" {{ $post->job_location == 'Ramechhap' ? 'selected' : '' }}>Ramechhap</option>
                 <option value="Rautahat" {{ $post->job_location == 'Rautahat' ? 'selected' : '' }}>Rautahat</option>
                 <option value="Rolpa" {{ $post->job_location == 'Rolpa' ? 'selected' : '' }}>Rolpa</option>
                 <option value="Rukum" {{ $post->job_location == 'Rukum' ? 'selected' : '' }}>Rukum</option>
                 <option value="Salyan" {{ $post->job_location == 'Salyan' ? 'selected' : '' }}>Salyan</option>
                 <option value="Sindhuli" {{ $post->job_location == 'Sindhuli' ? 'selected' : '' }}>Sindhuli</option>
                 <option value="Sindhupalchok" {{ $post->job_location == 'Sindhupalchok' ? 'selected' : '' }}>Sindhupalchok</option>
                 <option value="Surkhet" {{ $post->job_location == 'Surkhet' ? 'selected' : '' }}>Surkhet</option>
                 <option value="Syangja" {{ $post->job_location == 'Syangja' ? 'selected' : '' }}>Syangja</option>
                 <option value="Tanahu" {{ $post->job_location == 'Tanahu' ? 'selected' : '' }}>Tanahu</option>
                 <option value="Udayapur" {{ $post->job_location == 'Udayapur' ? 'selected' : '' }}>Udayapur</option>
                 <option value="Other" {{ $post->job_location == 'Other' ? 'selected' : '' }}>Other</option>
             </select>
         </div>


         <div class="mb-3">
             <label for="deadline" class="form-label">Deadline</label>
             <input type="date" class="form-control" name="deadline" id="deadline" value="{{ \Carbon\Carbon::parse($post->deadline)->format('Y-m-d') }}" required>
         </div>

         <div class="mb-3">
             <label for="education_level" class="form-label">Education Level</label>
             <select name="education_level" class="form-control" id="education_level" required>
                 <option value="" disabled {{ is_null($post->education_level) ? 'selected' : '' }}>Select Education Level</option>
                 <option value="Bachelors" {{ $post->education_level == 'Bachelors' ? 'selected' : '' }}>Bachelors</option>
                 <option value="High School" {{ $post->education_level == 'High School' ? 'selected' : '' }}>High School</option>
                 <option value="Master" {{ $post->education_level == 'Master' ? 'selected' : '' }}>Master</option>
                 <option value="SEE Mid School" {{ $post->education_level == 'SEE Mid School' ? 'selected' : '' }}>SEE Mid School</option>
                 <option value="Other" {{ $post->education_level == 'Other' ? 'selected' : '' }}>Other</option>
             </select>
         </div>


         <div class="mb-3">
             <label for="experience" class="form-label">Experience Level</label>
             <select name="experience" class="form-control" id="experience" required>
                 <option value="" disabled {{ is_null($post->experience) ? 'selected' : '' }}>Select Experience Level</option>
                 <option value="Fresher" {{ $post->experience == 'Fresher' ? 'selected' : '' }}>Fresher</option>
                 <option value="1-2 years" {{ $post->experience == '1-2 years' ? 'selected' : '' }}>1-2 Years</option>
                 <option value="3-5 years" {{ $post->experience == '3-5 years' ? 'selected' : '' }}>3-5 Years</option>
                 <option value="5+ years" {{ $post->experience == '5+ years' ? 'selected' : '' }}>5+ Years</option>
             </select>
         </div>

         <div class="mb-3">
             <label for="skills" class="form-label">Professional Skills</label>
             <div id="skills-container">
                 @php
                 $skills = explode(',', $post->skills);
                 @endphp

                 @foreach($skills as $skill)
                 <div class="input-group mb-2 skill-input">
                     <input type="text" class="form-control" name="skills[]" value="{{ trim($skill) }}" required>
                     <button type="button" class="btn btn-danger remove-skill">Remove</button>
                 </div>
                 @endforeach
             </div>
             <button type="button" class="btn btn-success" id="add-skill">Add Skills</button>
         </div>

         <div class="mb-3">
             <label for="specifications" class="form-label">Specifications</label>
             <input type="hidden" id="specifications" name="specifications" value="{{ $post->specifications }}">
                <div id="quillEditor" style="height:200px"></div>
         </div>

         <div class="form-group mb-3">
             <label for="status" class="form-label text-success">Status</label>
             <select name="status" id="status" class="form-control bg-info  text-dark border-success" required>
                 <option value="active" {{ $post->status == 'active' ? 'selected' : '' }}>Active</option>
                 <option value="inactive" {{ $post->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
             </select>
         </div>

         <button type="submit" class="btn btn-primary">Update Job Post</button>
     </form>
 </div>

 @endsection

 @push('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        $(document).ready(function() {
            var quill = new Quill('#quillEditor', {
                modules: {
                    toolbar: [
                        [{
                            'font': []
                        }, {
                            'size': []
                        }],
                        ['bold', 'italic'],
                        [{
                            list: 'ordered'
                        }, {
                            list: 'bullet'
                        }],
                        ['link', 'blockquote', 'code-block', 'image'],
                    ]
                },
                placeholder: 'Job Reqirement , Job Specifications etc ...',
                theme: 'snow'
            });


            const postBtn = document.querySelector('#postBtn');
            const postForm = document.querySelector('#postForm');
            const specifications = document.querySelector('#specifications');

            if (specifications.value) {
                quill.root.innerHTML = specifications.value;
            }

            postBtn.addEventListener('click', function(e) {
                e.preventDefault();
                specifications.value = quill.root.innerHTML

                postForm.submit();
            })
        })
    </script>

    <!-- For Skills -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const skillsContainer = document.getElementById('skills-container');
            const addSkillButton = document.getElementById('add-skill');

            function addSkillInput() {
                const skillInputDiv = document.createElement('div');
                skillInputDiv.className = 'input-group mb-2 skill-input';

                // Create input and button elements separately
                const skillInput = document.createElement('input');
                skillInput.type = 'text';
                skillInput.className = 'form-control';
                skillInput.name = 'skills[]'; // Name as an array to allow multiple skills
                // Do not set 'required' attribute

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.className = 'btn btn-danger remove-skill';
                removeButton.textContent = 'Remove';

                // Append input and button to the skillInputDiv
                skillInputDiv.appendChild(skillInput);
                skillInputDiv.appendChild(removeButton);

                // Append skillInputDiv to the skillsContainer
                skillsContainer.appendChild(skillInputDiv);

                // Add event listener to the remove button
                removeButton.addEventListener('click', removeSkillInput);
            }

            function removeSkillInput(event) {
                const skillInputDiv = event.target.parentElement;
                skillsContainer.removeChild(skillInputDiv);
            }

            if (addSkillButton) {
                addSkillButton.addEventListener('click', addSkillInput);
            }

            // Add listeners to existing remove buttons (if any)
            const removeButtons = document.querySelectorAll('.remove-skill');
            removeButtons.forEach(button => {
                button.addEventListener('click', removeSkillInput);
            });
        });
    </script>
@endpush
