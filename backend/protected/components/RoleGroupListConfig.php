<?php
/**
 * 用户角色分组
 */

class RoleGroupListConfig
{
    //机构角色ID
    public static $organizationRoleId = 1;

    //教师角色ID
    public static $teacherRoleId = 2;

    //学生角色ID
    public static $studentRoleId = 3;

    //家长角色ID
    public static $parentRoleId = 4;


    /**
     * 获取所有角色ID列表
     * @return array
     */
	public static function getRoleIdList(){
	    return [
	        self::$organizationRoleId => '机构',
            self::$teacherRoleId => '教师',
            self::$studentRoleId => '学生',
            self::$parentRoleId => '家长'
        ];
    }

    /**
     * 根据年级ID获取年级名称
     * @param $gradeId
     * @return string
     */
    public static function getGradeLabelByGradeId($gradeId){
	    $label = '';

	    $gradeList = self::getGradeList();
	    foreach ($gradeList as $item){
	        if ($item['value'] == $gradeId){
	            $label = $item['label'];
	            break;
            }
        }

        return $label;
    }

    /**
     * 获取在读学校下的年级列表
     * @return array
     */
    public static function getGradeList(){
        return [
            [
                'value' => 1,
                'label' => '一年级',
            ],
            [
                'value' => 2,
                'label' => '二年级',
            ],
            [
                'value' => 3,
                'label' => '三年级',
            ],
            [
                'value' => 4,
                'label' => '四年级',
            ],
            [
                'value' => 5,
                'label' => '五年级',
            ],
            [
                'value' => 6,
                'label' => '六年级',
            ],
            [
                'value' => 7,
                'label' => '初一',
            ],
            [
                'value' => 8,
                'label' => '初二',
            ],
            [
                'value' => 9,
                'label' => '初三',
            ],
            [
                'value' => 10,
                'label' => '高一',
            ],
            [
                'value' => 11,
                'label' => '高二',
            ],
            [
                'value' => 12,
                'label' => '高三',
            ],
        ];
    }

    /**
     * 教师/机构评价得分
     * @return array
     */
    public static function getScoreList(){
        return [
            1,
            2,
            3,
            4,
            5
        ];
    }

    /**
     * 标签列表
     * @return array
     */
    public static function getTagsList(){
        return [
            '认真负责',
            '谦虚',
            '可爱',
            '教学质量过硬',
            '讲的细心',
        ];
    }

    /**
     * 老师课程
     * @return array
     */
    public static function getTeacherCourse(){
        //托福，SAT, SAT II，SSAT, 雅思，GRE，其他
        return [
            [
                'value' => 1,
                'label' => '托福',
            ],
            [
                'value' => 2,
                'label' => 'SAT',
            ],
            [
                'value' => 3,
                'label' => 'SAT II',
            ],
            [
                'value' => 4,
                'label' => 'SSAT',
            ],
            [
                'value' => 5,
                'label' => '雅思',
            ],
            [
                'value' => 6,
                'label' => 'GRE',
            ],
            [
                'value' => 7,
                'label' => '其他',
            ],
        ];
    }

    /**
     * 机构业务
     * @return array
     */
    public static function getOrganizationYewu(){
        //美高申请，美本申请，美初申请，研究生申请
        return [
            [
                'value' => 1,
                'label' => '美高申请',
            ],
            [
                'value' => 2,
                'label' => '美本申请',
            ],
            [
                'value' => 3,
                'label' => '美初申请',
            ],
            [
                'value' => 4,
                'label' => '研究生申请',
            ],
        ];
    }
}