# Eco Tracking API
## How to use
### Build and run for development
- Let's run `./dev` and Enjoy ^^

### With Makefile
- Not yet (TODO)

## Git Workflow
- Switch to `master` branch and then create new branch from `master`, example `feature/foo`
```
git checkout master
```
```
git checkout -b feature/foo
```
```
git push -u origin feature/foo # Connect to remote origin
```

- After **finish** the task, create pull request to `develop` branch.  
The `develop` branch using for testing environment

- When everything fine, you rebase your branch with master and create pull request to `master`
```
git fetch # update origin master branch
```
```
git rebase origin/master
```
```
git push
```

## Environment
| Name       | Port | Description         | URL                   | Notes |
|------------|------|---------------------|-----------------------|-------|
| API        | 801  | API Server          | http://localhost:801  |       |
| PHPMyadmin | 881  | Management Database | http://localhost:881  |       |
