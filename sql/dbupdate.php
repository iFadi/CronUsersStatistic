<#1>
<?php

// Check if the table already exists
if (!$ilDB->tableExists('crn_usr_statistics')) {
    $fields = [
        'id' => [
            'type' => 'integer',
            'length' => 4,
            'notnull' => true,
            'default' => 0
        ],
        'stat_date' => [
            'type' => 'date',
            'notnull' => true,
        ],
        'user_count' => [
            'type' => 'integer',
            'length' => 4,
            'notnull' => true,
            'default' => 0
        ],
        'created_at' => [
            'type' => 'timestamp',
            'notnull' => true,
            'default' => $ilDB->now()
        ]
    ];

    $ilDB->createTable('crn_usr_statistics', $fields);
    $ilDB->addPrimaryKey('crn_usr_statistics', ['id']);
    $ilDB->createSequence('crn_usr_statistics'); // Create a sequence for id field
}
?>

<#2>
<?php

if (!$ilDB->tableExists('crn_usr_settings')) {
    $ilDB->createTable('crn_usr_settings', array(
        'keyword' => array(
            'type' => 'text',
            'length' => 50,
            'notnull' => true
        ),
        'value' => array(
            'type' => 'clob',
            'notnull' => false
        ),
    ));
    $ilDB->addPrimaryKey('crn_usr_settings', array('keyword'));
}
?>
