<?php
/**
 * This is the template for generating the model class of a specified table.
 */

/** @var yii\web\View $this */
/** @var yii\gii\generators\model\Generator $generator */
/** @var string $tableName full table name */
/** @var string $className class name */
/** @var string $queryClassName query class name */
/** @var yii\db\TableSchema $tableSchema */
/** @var array $properties list of properties (property => [type, name. comment]) */
/** @var string[] $labels list of attribute labels (name => label) */
/** @var string[] $rules list of validation rules */
/** @var array $relations list of relations (name => relation declaration) */

echo "<?php\n";
?>

namespace <?= $generator->ns ?>;

use Yii;

/**
* This is the model class for table "<?= $generator->generateTableName($tableName) ?>".
*
<?php foreach ($properties as $property => $data): ?>
    * @property <?= "{$data['type']} \${$property}" . ($data['comment'] ? ' ' . strtr($data['comment'], ["\n" => ' ']) : '') . "\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
    *
    <?php foreach ($relations as $name => $relation): ?>
        * @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
    <?php endforeach; ?>
<?php endif; ?>
*/
class <?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{

/**
* {@inheritdoc}
*/
const STATUS_ACTIVE = 1;
const STATUS_DELETED = 0;
const STATUS_INACTIVE = 2;


public static function tableName()
{
return '<?= $generator->generateTableName($tableName) ?>';
}
<?php if ($generator->db !== 'db'): ?>

    /**
    * @return \yii\db\Connection the database connection used by this AR class.
    */
    public static function getDb()
    {
    return Yii::$app->get('<?= $generator->db ?>');
    }
<?php endif; ?>

/**
* {@inheritdoc}
*/
public function rules()
{
return [<?= empty($rules) ? '' : ("\n            " . implode(",\n            ", $rules) . ",\n        ") ?>];
}

/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
<?php foreach ($labels as $name => $label): ?>
    <?= "'$name' => " . $generator->generateString($label) . ",\n" ?>
<?php endforeach; ?>
];
}
<?php foreach ($relations as $name => $relation): ?>

    /**
    * Gets query for [[<?= $name ?>]].
    *
    * @return <?= $relationsClassHints[$name] . "\n" ?>
    */
    public function get<?= $name ?>()
    {
    <?= $relation[0] . "\n" ?>
    }
<?php endforeach; ?>
<?php if ($queryClassName): ?>
    <?php
    $queryClassFullName = ($generator->ns === $generator->queryNs) ? $queryClassName : '\\' . $generator->queryNs . '\\' . $queryClassName;
    echo "\n";
    ?>
    /**
    * {@inheritdoc}
    * @return <?= $queryClassFullName ?> the active query used by this AR class.
    */
    public static function find()
    {
    $query = new <?= $queryClassFullName ?>(get_called_class());
    return $query->active();
    }

    public function canDelete()
    {
    return true;
    }
    public function behaviors()
    {
    return [
    'timestamp' => [
    'class' => TimestampBehavior::class
    ],
    [
    'class' => BlameableBehavior::class,
    'createdByAttribute' => 'created_by',
    'updatedByAttribute' => 'updated_by',
    ],
    'softDeleteBehavior' => [
    'class' => SoftDeleteBehavior::class,
    'softDeleteAttributeValues' => [
    'deleted_at' => time(),
    'status' => self::STATUS_DELETED
    ],
    'restoreAttributeValues' => [
    'deleted_at' => 0,
    'status' => self::STATUS_ACTIVE
    ],
    'replaceRegularDelete' => false, // mutate native `delete()` method
    'invokeDeleteEvents' => false
    ],
    ];
    }

    public function fields()
    {
    return [
    <?php foreach ($labels as $name => $label): ?>
        <?= "'$name' " . ",\n" ?>
    <?php endforeach; ?>
    ];
    }

    public function extraFields()
    {
    return [];
    }
<?php endif; ?>
}
