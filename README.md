# webad_light_plan ライトプラン

>> ## ※自動デプロイしているので、FTPからのファイルのアップロードは禁止  
<br>
<br>
<br>
  
  
## Git運用
>mainブランチ = 本番用ブランチ  
deployブランチ = ステージング用ブランチ  
個人ブランチ(yamauchi等) = 各個人の作業用ブランチ

##### 概要
mainブランチをpushするとGitHub Actionsにより、本番へDeploy処理をおこないます。(light-plan.web-ad.co.jp)  
<!-- developブランチをpushすると、ステージング領域にDeploy処理をおこないます。(test.mogoo.info) -->

1. git fetchをおこなう
2. git branch ●●● で個人ブランチを作成
3. 2でつくった個人ブランチで作業
4. 作業完了後、developにマージして、developをpush (個人ブランチはpush不要です)
5. GitHubのリポジトリページのメニューの、"Actions"よりActionsの処理に不具合がないか確認。(ステージングへDeploy)
6. 5の処理が完了後、[light-plan.web-ad.co.jp](https://light-plan.web-ad.co.jp)ページを見て作業に問題がないか確認
7. developブランチをmainへマージし、mainをpush
8. Actionsページを開き、本番へのDeploy処理が問題なく完了したか確認
9. [light-plan.web-ad.co.jp](https://light-plan.web-ad.co.jp)へアクセスし、問題ないことを確認したら完了
