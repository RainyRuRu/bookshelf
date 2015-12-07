# 作業 - 借書系統

## 目的

* 熟悉 Laravel 骨架
* 熟悉以 Behat 來輔助 BDD 開發

## 需求說明

實作一個小型圖書館系統，功能包含：

* 註冊帳號
* 登入登出
* 借還書籍

### 已預先定義的網址

為了模擬工作流程，這個專案假設樣版已經製作，並套用了以下網址路徑以模擬頁面動線。

* `/` ：系統首頁。
* `/auth/login` ：登入頁。
* `/auth/logout` ：暫時連到登入頁。
* `/auth/register` ：註冊頁。

路徑參考官方手冊的 [Authentication](http://laravel.com/docs/5.1/authentication) 的設定。

> 註： Laravel Taiwan 有翻譯[中文版本](http://laravel.tw/docs/5.1/authentication)。

### 注意事項

* 註冊帳號時不使用 `email` 做為 identity ，改用 `username` 。
* `email` 為 `username` 加上 `@kkbox.com` 結尾；這件事要在註冊時自動處理，不需要使用者填寫。

## 系統需求

* PHP 5.5.9+
* Node.JS 0.12+
* LibSASS

## 安裝

* 先 fork [作業骨架](https://gitlab.kkcorp/jaceju/homework-bdd-bookshelf) 。
* 將 repo clone 下來：

```
git clone git@gitlab.kkcorp:YOUR_NAME/homework-bdd-bookshelf.git YOUR_PROJECT
```

然後進新專案進行安裝：

```
cd YOUR_PROJECT
composer setup
```

## 開發

開發時建議在本機上實作，因為資料庫是使用 SQLite ，所以不需連線至外部伺服器。

### 樣版

在 `resources/views` 已經有準備好相關的靜態樣版，實作時請自行套用相關程式碼。

* `resources/views/layouts/app.blade.php` ：主樣版。
* `resources/views/auth/register.blade.php` ：註冊頁。
* `resources/views/auth/login.blade.php` ：登入頁。
* `resources/views/bookshelf/index.blade.php` ：書籍列表頁。

### 即時預覽

開發時執行以下指令，會啟動 [browser-sync](http://www.browsersync.io/) 進行即時預覽：

```
gulp
```

### 進行測試

利用 behat 來進行測試：

```
./vendor/bin/behat
```

或加上 `--append-snippets` 來建立 step definition 。

### Feature

詳細的 feature 檔放在 `features` 目錄下，要加入新 scenario 的話，只要把前面的 `#` 去掉即可。

* `features/membership/Registration.feature` ：註冊。
* `features/membership/Authentication.feature` ：登入。
* `features/bookshelf/Bookshelf.feature` ：書籍列表與借還書。

> 註： feature 檔已經過確認，請儘量在不修改 step 內容的狀況下完成需求。

### 開發循環

* 在 feature 加入待完成的 scenario
* 加入 step definition
* 填寫 context 類別中的 step definition
* 建立 model 與 migration
* 建立 controller
* 重新規劃 route 與 controller 的對應
* route 加入驗證 middleware 保護
* 填寫 controller 內容以符合 scenario

## 完成後的程式碼參考

在 [https://gitlab.kkcorp/jaceju/demo-bdd-bookshelf](https://gitlab.kkcorp/jaceju/demo-bdd-bookshelf) 有完成後的程式碼，如果卡關的話可以參考看看。