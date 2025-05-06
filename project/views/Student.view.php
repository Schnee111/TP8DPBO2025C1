<?php
class StudentView {
    public function showAll($students) {
        $rows = "";
        $no = 1;
        
        foreach ($students as $student) {
            $rows .= "<tr>
                <td>{$no}</td>
                <td>{$student['name']}</td>
                <td>{$student['nim']}</td>
                <td>{$student['phone']}</td>
                <td>{$student['join_date']}</td>
                <td>
                    <a href='student.php?action=edit&id={$student['id']}' class='btn btn-primary'>Edit</a>
                    <a href='student.php?action=delete&id={$student['id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
            </tr>";
            $no++;
        }
        
        $replacements = [
            'TITLE' => 'Students',
            'DATA_TABLE' => $rows,
            'CONTENT_START' => '',
            'CONTENT_END' => ''
        ];
        
        TemplateProcessor::render('templates/student/list.html', $replacements, 'Students');
    }
    
    public function showAddForm() {
        $replacements = [
            'TITLE' => 'Add Student',
            'FORM_ACTION' => 'student.php?action=add',
            'NAME_VAL' => '',
            'NIM_VAL' => '',
            'PHONE_VAL' => '',
            'JOIN_VAL' => '',
            'BUTTON_LABEL' => 'Submit',
            'CONTENT_START' => '',
            'CONTENT_END' => ''
        ];
        
        TemplateProcessor::render('templates/student/form.html', $replacements, 'Add Student');
    }
    
    public function showEditForm($student) {
        $replacements = [
            'TITLE' => 'Edit Student',
            'FORM_ACTION' => 'student.php?action=edit&id=' . $student->getId(),
            'NAME_VAL' => $student->getName(),
            'NIM_VAL' => $student->getNim(),
            'PHONE_VAL' => $student->getPhone(),
            'JOIN_VAL' => $student->getJoinDate(),
            'BUTTON_LABEL' => 'Update',
            'CONTENT_START' => '',
            'CONTENT_END' => ''
        ];
        
        TemplateProcessor::render('templates/student/form.html', $replacements, 'Edit Student');
    }
}
?>