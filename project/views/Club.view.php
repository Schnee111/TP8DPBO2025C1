<?php
class ClubView {
    public function showAll($clubs) {
        $rows = "";
        $no = 1;
        
        foreach ($clubs as $club) {
            $rows .= "<tr>
                <td>{$no}</td>
                <td>{$club['name']}</td>
                <td>{$club['description']}</td>
                <td>{$club['founded_date']}</td>
                <td>
                    <a href='club.php?action=edit&id={$club['id']}' class='btn btn-primary'>Edit</a>
                    <a href='club.php?action=delete&id={$club['id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
            </tr>";
            $no++;
        }
        
        $replacements = [
            'TITLE' => 'Clubs',
            'DATA_TABLE' => $rows,
            'CONTENT_START' => '',
            'CONTENT_END' => ''
        ];
        
        TemplateProcessor::render('templates/club/list.html', $replacements, 'Clubs');
    }
    
    public function showAddForm() {
        $replacements = [
            'TITLE' => 'Add Club',
            'FORM_ACTION' => 'club.php?action=add',
            'NAME_VAL' => '',
            'DESCRIPTION_VAL' => '',
            'FOUNDED_VAL' => '',
            'BUTTON_LABEL' => 'Submit',
            'CONTENT_START' => '',
            'CONTENT_END' => ''
        ];
        
        TemplateProcessor::render('templates/club/form.html', $replacements, 'Add Club');
    }
    
    public function showEditForm($club) {
        $replacements = [
            'TITLE' => 'Edit Club',
            'FORM_ACTION' => 'club.php?action=edit&id=' . $club->getId(),
            'NAME_VAL' => $club->getName(),
            'DESCRIPTION_VAL' => $club->getDescription(),
            'FOUNDED_VAL' => $club->getFoundedDate(),
            'BUTTON_LABEL' => 'Update',
            'CONTENT_START' => '',
            'CONTENT_END' => ''
        ];
        
        TemplateProcessor::render('templates/club/form.html', $replacements, 'Edit Club');
    }
}
?>