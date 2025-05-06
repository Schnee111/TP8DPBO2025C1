<?php
class ClubMemberView {
    public function showAll($members) {
        $rows = "";
        $no = 1;
        
        foreach ($members as $member) {
            $rows .= "<tr>
                <td>{$no}</td>
                <td>{$member['student_name']}</td>
                <td>{$member['club_name']}</td>
                <td>{$member['join_date']}</td>
                <td>{$member['role']}</td>
                <td>
                    <a href='club_member.php?action=edit&id={$member['id']}' class='btn btn-primary'>Edit</a>
                    <a href='club_member.php?action=delete&id={$member['id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
            </tr>";
            $no++;
        }
        
        $replacements = [
            'TITLE' => 'Club Members',
            'DATA_TABLE' => $rows,
            'CONTENT_START' => '',
            'CONTENT_END' => ''
        ];
        
        TemplateProcessor::render('templates/club_member/list.html', $replacements, 'Club Members');
    }
    
    public function showAddForm($students, $clubs) {
        $studentsOptions = '';
        foreach ($students as $student) {
            $studentsOptions .= "<option value='{$student['id']}'>{$student['name']} ({$student['nim']})</option>";
        }
        
        $clubsOptions = '';
        foreach ($clubs as $club) {
            $clubsOptions .= "<option value='{$club['id']}'>{$club['name']}</option>";
        }
        
        $replacements = [
            'TITLE' => 'Add Club Member',
            'FORM_ACTION' => 'club_member.php?action=add',
            'STUDENTS_OPTIONS' => $studentsOptions,
            'CLUBS_OPTIONS' => $clubsOptions,
            'JOIN_VAL' => '',
            'ROLE_MEMBER' => 'selected',
            'ROLE_PRESIDENT' => '',
            'ROLE_VICE_PRESIDENT' => '',
            'ROLE_SECRETARY' => '',
            'ROLE_TREASURER' => '',
            'BUTTON_LABEL' => 'Submit',
            'CONTENT_START' => '',
            'CONTENT_END' => ''
        ];
        
        TemplateProcessor::render('templates/club_member/form.html', $replacements, 'Add Club Member');
    }
    
    public function showEditForm($member, $students, $clubs) {
        $studentsOptions = '';
        foreach ($students as $student) {
            $selected = ($student['id'] == $member->getStudentId()) ? 'selected' : '';
            $studentsOptions .= "<option value='{$student['id']}' {$selected}>{$student['name']} ({$student['nim']})</option>";
        }
        
        $clubsOptions = '';
        foreach ($clubs as $club) {
            $selected = ($club['id'] == $member->getClubId()) ? 'selected' : '';
            $clubsOptions .= "<option value='{$club['id']}' {$selected}>{$club['name']}</option>";
        }
        
        $replacements = [
            'TITLE' => 'Edit Club Member',
            'FORM_ACTION' => 'club_member.php?action=edit&id=' . $member->getId(),
            'STUDENTS_OPTIONS' => $studentsOptions,
            'CLUBS_OPTIONS' => $clubsOptions,
            'JOIN_VAL' => $member->getJoinDate(),
            'ROLE_MEMBER' => $member->getRole() == 'Member' ? 'selected' : '',
            'ROLE_PRESIDENT' => $member->getRole() == 'President' ? 'selected' : '',
            'ROLE_VICE_PRESIDENT' => $member->getRole() == 'Vice President' ? 'selected' : '',
            'ROLE_SECRETARY' => $member->getRole() == 'Secretary' ? 'selected' : '',
            'ROLE_TREASURER' => $member->getRole() == 'Treasurer' ? 'selected' : '',
            'BUTTON_LABEL' => 'Update',
            'CONTENT_START' => '',
            'CONTENT_END' => ''
        ];
        
        TemplateProcessor::render('templates/club_member/form.html', $replacements, 'Edit Club Member');
    }
}  
?>