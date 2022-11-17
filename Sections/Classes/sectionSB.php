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
        echo "
            <div class=\"tab-pane fade show active\" id=\"sectionTab\" role=\"tabpanel\" aria-labelledby=\"section-tab\" tabindex=\"0\">
                <!-- This div will hold the header of the tab container -->
                <div class=\"row mt-4 mb-4\"> <!-- Header of the container -->

                    <!--Search-->
                    <div class=\"col\"> <!-- Search Box -->
                        <div class=\"col input-group mb-3\">
                            <input type=\"text\" class=\"form-control\" id=\"searchSection\" placeholder=\"Search\" aria-label=\"Search\" aria-describedby=\"search\">
                            <button class=\"btn btn-outline-palette4 btn-palette2\" type=\"button\" id=\"search\" onClick=\"getSections()\"><i class=\"bi bi-search\"></i></button> <!-- Search Button -->
                        </div>

                    </div>

                    <!--Adding Section-->
                    <div class=\"col-2\"> <!-- Button for toggling a modal for creating a new Section -->
                        <button type=\"button\" class=\"btn btn-outline-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#staticBackdrop\">
                            Add Section
                        </button>
                    </div>
                </div>

                <!-- Table that will show all results from query -->
                <table class=\"table table-hover mt-4\">
                    <thead>
                        <tr>
                            <th scope=\"col\">#</th>
                            <th scope=\"col\">Section Name</th>
                            <th scope=\"col\"># of Pupils</th>
                            <th scope=\"col\">Assigned Teacher</th>
                            <th scope=\"col\">Actions</th>
                        </tr>
                    </thead>

                    <tbody id=\"cont_sections\">

                        <!--Added section will appear here-->
                        <!--A row will generate here-->

                    </tbody>
                </table>
                <!-- -->

            </div>
        ";
    }

    function generateTabTeacher() {
        // This is the Student Tab
        echo "
            <div class=\"tab-pane fade show active\" id=\"studentTab\" role=\"tabpanel\" aria-labelledby=\"student-tab\" tabindex=\"0\">

                <div class=\"row mt-4 mb-4\">
                    <!--Search-->
                    <div class=\"col\"> <!-- Search Box Div -->

                        <div class=\"col input-group mb-3\">
                            <input type=\"text\" class=\"form-control\" id=\"searchTextStudent\" placeholder=\"Search\" aria-label=\"Search\" aria-describedby=\"search\"> 
                            <button class=\"btn btn-outline-palette4 btn-palette2\" type=\"button\" id=\"search\" onClick=\"getStudents()\"><i class=\"bi bi-search\"></i></button> <!-- Search Button -->
                        </div>

                    </div>

                    <!--Viewing Students-->
                    <!--<div class=\"col-2\"> <!-- Button for toggling a modal for viewing selected Students
                        <button type=\"button\" class=\"btn btn-outline-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#modalSelStudents\">
                            Selected Students
                        </button>
                    </div>-->

                    <!--Saving Students-->
                    <div class=\"col-2\"> <!-- Button for toggling a modal for saving selected Students -->
                        <button type=\"button\" class=\"btn btn-outline-primary\" id=\"saveSelStudents\" onClick=\"saveSelectionStudents(); toggleBtn('saveSelStudents', true)\" disabled>
                            Save Selection
                        </button>
                    </div>

                </div>

                <!-- Table for showing results from query -->
                <table class=\"table table-hover mt-4\">
                    <thead>
                        <tr>
                            <th scope=\"col\">#</th>
                            <th scope=\"col\">First Name</th>
                            <th scope=\"col\">Middle Name</th>
                            <th scope=\"col\">Last Name</th>
                            <th scope=\"col\">Selection</th>
                        </tr>
                    </thead>

                    <tbody id=\"cont_students\">
                        <!--Added section will appear here-->
                        <!-- tr will be added here from queries -->
                        <td>1</td>
                        <td>Darry</td>
                        <td>Argon</td>
                        <td>Rose</td>
                        <td><input type='checkbox' value='1'></td>
                    </tbody>

                </table>

            </div>
        ";

        // This is the Lesson Tab
        echo "
            <div class=\"tab-pane fade\" id=\"lessonTab\" role=\"tabpanel\" aria-labelledby=\"lesson-tab\" tabindex=\"0\">
                <div class=\"row mt-4 mb-4\">
                    <!--Search-->
                    <div class=\"col\">
                        <div class=\"col input-group mb-3\">
                            <input type=\"text\" class=\"form-control\" id=\"searchTextLesson\" placeholder=\"Search\" aria-label=\"Search\" aria-describedby=\"search\">
                            <button class=\"btn btn-outline-palette4 btn-palette2\" type=\"button\" id=\"search\" onClick=\"getLessons(".$_SESSION['id'].")\"><i class=\"bi bi-search\"></i></button>
                        </div>
                    </div>

                    <!--Viewing Lessons-->
                    <!--<div class=\"col-2\"> <!-- Button for toggling a modal for viewing selected Lessons
                        <button type=\"button\" class=\"btn btn-outline-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#modalSelLessons\">
                            Selected Lessons
                        </button>
                    </div>-->

                    <!--Saving Lessons-->
                    <div class=\"col-2\"> <!-- Button for toggling a modal for viewing selected Lessons -->
                        <button type=\"button\" class=\"btn btn-outline-primary\" id=\"saveSelLessons\" onClick=\"saveSelectionLesson(); toggleBtn('saveSelLessons', true)\" disabled>
                            Save Selection
                        </button>
                    </div>


                </div>

                    <table class=\"table table-hover mt-4\">
                        <thead>
                            <tr>
                                <th scope=\"col\">#</th>
                                <th scope=\"col\">Lesson Name</th>
                                <th scope=\"col\">Description</th>
                                <th scope=\"col\">Material Owner</th>
                                <th scope=\"col\">Selection</th>
                            </tr>
                        </thead>

                        <tbody id=\"cont_lessons\">
                            <!--Added lesson will appear here-->
                            <!-- This is where tr will be added from results -->
                            
                        </tbody>

                    </table>

                </div>

            </div>
        ";

        // This is the Assessment Tab
        // echo "

        // ";
    }
        //

    //
}