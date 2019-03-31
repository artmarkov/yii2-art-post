<?php

namespace artsoft\post\models\search;

use artsoft\post\models\Post;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PostSearch represents the model behind the search form about `common\models\Post`.
 */
class PostSearch extends Post
{

    public $published_at_operand;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'created_by', 'updated_by', 'status', 'comment_status', 'revision'], 'integer'],
            [['gridTagsSearch', 'published_at_operand', 'title', 'content', 'published_at', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find()->joinWith('translation');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->request->cookies->getValue('_grid_page_size', 20),
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
         
        $query->with(['tags']);       
        
        if ($this->gridTagsSearch) {
            $query->joinWith(['tags']);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
            'comment_status' => $this->comment_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'revision' => $this->revision,
            'post_tag_post.tag_id' => $this->gridTagsSearch,
        ]);

        switch ($this->published_at_operand) {
            case '=':
                $query->andFilterWhere(['>=', 'published_at', ($this->published_at) ? strtotime($this->published_at) : null]);
                $query->andFilterWhere(['<=', 'published_at', ($this->published_at) ? strtotime($this->published_at . ' 23:59:59') : null]);
                break;
            case '>':
                $query->andFilterWhere(['>', 'published_at', ($this->published_at) ? strtotime($this->published_at . ' 23:59:59') : null]);
                break;
            case '<':
                $query->andFilterWhere(['<', 'published_at', ($this->published_at) ? strtotime($this->published_at) : null]);
                break;
            default:
                break;
        }
        
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }

}
