Feature: 使用者可以借還書籍
    In order to 借還書籍
    As a 使用者
    I want to 查看書籍列表、借書及還書

    Background:
       Given 我以帳號 "jaceju" 登入系統
       And 帳號 "trishalin" 已註冊
       And 帳號 "johnhuang" 已註冊
       And 書架上現有書籍
	       | 書籍名稱                  | 出借狀況  |
	       | 專案管理實務              | 可借出    |
	       | HTML5 + CSS3 專用網站設計 | 可借出    |
	       | JavaScript 學習手冊       | 可借出    |
	       | 精通 VI                   | 可借出    |
	       | PHP 聖經                  | 可借出    |
       And 書籍 "專案管理實務" 已被 "trishalin" 借出
       And 書籍 "精通 VI" 已被 "johnhuang" 借出

    Scenario: 使用者可查看書籍列表及出借狀況
       When 進入首頁
       Then 顯示書籍清單、出借狀況
            | 書籍名稱                  | 出借狀況  |
            | 專案管理實務              | 已借出    |
            | HTML5 + CSS3 專用網站設計 | 可借出    |
            | JavaScript 學習手冊       | 可借出    |
            | 精通 VI                   | 已借出    |
            | PHP 聖經                  | 可借出    |

    Scenario: 使用者借書
        Given 在列表的 "HTML5 + CSS3 專用網站設計"
        When 點選「借書」按鈕
        Then 出借狀況顯示 "已借出"
        And 顯示「還書」按鈕

    Scenario: 使用者借 2 本書
        Given 在列表的 "PHP 聖經"
        And 書籍 "HTML5 + CSS3 專用網站設計" 已被 "jaceju" 借出
        When 點選「借書」按鈕
        And 顯示「還書」按鈕

    Scenario: 使用者最多只能借 2 本書
        Given 在列表的 "PHP 聖經"
        And 書籍 "HTML5 + CSS3 專用網站設計" 已被 "jaceju" 借出
        And 書籍 "JavaScript 學習手冊" 已被 "jaceju" 借出
        When 點選「借書」按鈕
        Then 顯示錯誤訊息 "每個帳號最多只能借 2 本書"

    Scenario: 使用者還書
        Given 書籍 "PHP 聖經" 已被 "jaceju" 借出
        And 在列表的 "PHP 聖經"
        When 點選「還書」按鈕
        Then 出借狀況顯示 "可借出"
        And 顯示「借書」按鈕

    Scenario: 使用者不能歸選別人借的書
        Given 在列表的 "專案管理實務"
        Then 不顯示「還書」按鈕