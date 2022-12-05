<?php

class sectionSB {
    // Variables

    //

    // Built-in Functions
    function __construct() {
        
    }
    //

    // Custom Functions
        // Nav Tabs
    function navTabPrincipal() {
        echo "
            <button class=\"nav-link active\" id=\"nav-section\" data-bs-toggle=\"tab\" data-bs-target=\"#sectionTab\" type=\"button\" role=\"tab\" aria-controls=\"section\" aria-selected=\"true\">Section</button>
        ";
    }

    function navTabTeacher() {
        echo "
            <button class=\"nav-link active\" id=\"nav-student\" data-bs-toggle=\"tab\" data-bs-target=\"#studentTab\" type=\"button\" role=\"tab\" aria-controls=\"student\" aria-selected=\"false\">Student</button>
            <button class=\"nav-link\" id=\"nav-lesson\" data-bs-toggle=\"tab\" data-bs-target=\"#lessonTab\" type=\"button\" role=\"tab\" aria-controls=\"lesson\" aria-selected=\"false\">Lesson Materials</button>
            <!--<button class=\"nav-link\" id=\"nav-assessment\" data-bs-toggle=\"tab\" data-bs-target=\"#assessTab\" type=\"button\" role=\"tab\" aria-controls=\"assess\" aria-selected=\"false\">Assessment Materials</button>-->
        ";
    }
        //

        // Tab Bodies
    function generateTabPrincipal() {
        echo '
            <div class="account-table d-flex flex-row position-relative shadow-sm p-3 mb-3 bg-body rounded">
                <div class="col-5">
                    <div class="input-group mb-3 d-flex">
                        <input type="text" class="form-control" id="searchSection" placeholder="Search . . ." aria-label="Search . . ." aria-describedby="searchBTN">
                        <button class="btn btn-button" type="button" id="searchBTN" onClick="getSections()">Search</button>
                    </div>
                </div>
                <div class="account-button position-absolute end-0 d-flex flex-row">
                    <div class="col pe-3">
                        <!--Add Account-->
                        <button type ="button" class="btn btn-outline-button" data-bs-toggle="modal" data-bs-target="#addSection">Add Section</button>
                    </div>
                </div>
            </div>
        ';
        echo '
        <div class="tab-pane fade show active" id="section-tab-pane" role="tabpanel" aria-labelledby="section-tab" tabindex="0">
            <table class="table table-hover table-responsive-sm mt-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Section Name</th>
                        <th scope="col"># Pupils</th>
                        <th scope="col">Assigned Teacher</th>
                        <th scope="col gap-3">Actions</th>
                    </tr>
                </thead>
                <tbody id="cont_sections">
                    <!--Sample Data-->
                    <tr>
                        <td>69</td>
                        <td>Rainbow</td>
                        <td>13</td>
                        <td>Kaoruko Mifune</td>
                        <td>
                            <div class="hover-button">
                                <button type="button" class="btn btn-sm btn-button" data-bs-toggle="modal" data-bs-target="#editAccount"><i class="bi bi-pencil-square"></i></button>
                                <button type="button" class="btn btn-sm btn-button" data-bs-toggle="modal" data-bs-target="#deleteAccount"><i class="bi bi-trash3"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        ';
    }

    function generateTabTeacher() {
        // This is the Student Tab
        echo '
            <div class="tab-pane fade show active" id="studentTab" role="tabpanel" aria-labelledby="student-tab" tabindex="0">
                <div class="account-table d-flex flex-row position-relative shadow-sm p-3 mb-3 bg-body rounded">
                    <div class="col-5">
                        <div class="input-group mb-3 d-flex">
                            <input type="text" class="form-control" id="searchStudents" placeholder="Search . . ." aria-label="Search . . ." aria-describedby="searchBTN">
                            <button class="btn btn-button" type="button" id="searchBTN" onClick="getStudents()">Search</button>
                        </div>
                    </div>
                    <div class="account-button position-absolute end-0 d-flex flex-row">
                        <!--Saving Students-->
                        <div class="col-2"> <!-- Button for toggling a modal for saving selected Students -->
                            <button type="button" class="btn btn-button" id="saveSelStudents" onClick="saveSelectionStudents(); toggleBtn(\'saveSelStudents\', true)" disabled>
                                Save Selection
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table for showing results from query -->
                <table class="table table-hover mt-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Selection</th>
                        </tr>
                    </thead>

                    <tbody id="cont_students">
                        <!--Added section will appear here-->
                        <!-- tr will be added here from queries -->
                        <td>1</td>
                        <td>Darry</td>
                        <td>Argon</td>
                        <td>Rose</td>
                        <td><input type="checkbox" value="1"></td>
                    </tbody>

                </table>
            </div>
        ';

        // This is the Lesson Tab
        echo '
            <div class="tab-pane fade" id="lessonTab" role="tabpanel" aria-labelledby="lesson-tab" tabindex="0">
                <div class="account-table d-flex flex-row position-relative shadow-sm p-3 mb-3 bg-body rounded">
                    <div class="col-5">
                        <div class="input-group mb-3 d-flex">
                            <input type="text" class="form-control" id="searchLessons" placeholder="Search . . ." aria-label="Search . . ." aria-describedby="searchBTN">
                            <button class="btn btn-button" type="button" id="searchBTN" onClick="getLessons()">Search</button>
                        </div>
                    </div>
                    <div class="account-button position-absolute end-0 d-flex flex-row">
                        <!--Saving Lessons-->
                        <div class="col-2"> <!-- Button for toggling a modal for saving selected Students -->
                            <button type="button" class="btn btn-button" id="saveSelLessons" onClick="saveSelectionLesson(); toggleBtn(\'saveSelLessons\', true)" disabled>
                                Save Selection
                            </button>
                        </div>
                    </div>
                </div>

                <table class="table table-hover mt-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Lesson Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Material Owner</th>
                            <th scope="col">Selection</th>
                        </tr>
                    </thead>

                    <tbody id="cont_lessons">
                        <!--Added lesson will appear here-->
                        <!-- This is where tr will be added from results -->
                        
                    </tbody>

                </table>
            </div>
        ';
        // echo "
        //     <div class=\"tab-pane fade\" id=\"lessonTab\" role=\"tabpanel\" aria-labelledby=\"lesson-tab\" tabindex=\"0\">
        //         <div class=\"row mt-4 mb-4\">
        //             <!--Search-->
        //             <div class=\"col\">
        //                 <div class=\"col input-group mb-3\">
        //                     <input type=\"text\" class=\"form-control\" id=\"searchTextLesson\" placeholder=\"Search\" aria-label=\"Search\" aria-describedby=\"search\">
        //                     <button class=\"btn btn-outline-palette4 btn-palette2\" type=\"button\" id=\"search\" onClick=\"getLessons(".$_SESSION['id'].")\"><i class=\"bi bi-search\"></i></button>
        //                 </div>
        //             </div>

        //             <!--Viewing Lessons-->
        //             <!--<div class=\"col-2\"> <!-- Button for toggling a modal for viewing selected Lessons
        //                 <button type=\"button\" class=\"btn btn-outline-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#modalSelLessons\">
        //                     Selected Lessons
        //                 </button>
        //             </div>-->

        //             <!--Saving Lessons-->
        //             <div class=\"col-2\"> <!-- Button for toggling a modal for viewing selected Lessons -->
        //                 <button type=\"button\" class=\"btn btn-outline-primary\" id=\"saveSelLessons\" onClick=\"saveSelectionLesson(); toggleBtn('saveSelLessons', true)\" disabled>
        //                     Save Selection
        //                 </button>
        //             </div>


        //         </div>

        //             <table class=\"table table-hover mt-4\">
        //                 <thead>
        //                     <tr>
        //                         <th scope=\"col\">#</th>
        //                         <th scope=\"col\">Lesson Name</th>
        //                         <th scope=\"col\">Description</th>
        //                         <th scope=\"col\">Material Owner</th>
        //                         <th scope=\"col\">Selection</th>
        //                     </tr>
        //                 </thead>

        //                 <tbody id=\"cont_lessons\">
        //                     <!--Added lesson will appear here-->
        //                     <!-- This is where tr will be added from results -->
                            
        //                 </tbody>

        //             </table>

        //         </div>

        //     </div>
        // ";

        // This is the Assessment Tab
        // echo "

        // ";
    }
        //

    //
}