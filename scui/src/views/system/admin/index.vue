<template>
	<el-container>
		<el-header>
			<div class="left-panel">
				<el-button type="primary" icon="el-icon-plus" @click="add">增加</el-button>
				<!--				<el-button type="danger" plain icon="el-icon-delete" :disabled="selection.length==0" @click="batch_del"></el-button>-->
				<!--				<el-button type="primary" plain :disabled="selection.length!=1" @click="permission">权限设置</el-button>-->
			</div>
			<div class="right-panel">
				<div class="right-panel-search">
					<el-input v-model="search.name" placeholder="登录名" clearable></el-input>
					<el-input v-model="search.real_name" placeholder="真实姓名" clearable></el-input>
					<el-button type="primary" icon="el-icon-search" @click="upsearch">搜索</el-button>
				</div>
			</div>
		</el-header>
		<el-main class="nopadding">
			<scTable ref="table" :apiObj="apiObj" row-key="id" border stripe>
				<!--				<el-table-column type="selection" width="40"></el-table-column>-->
				<el-table-column label="id" prop="id" width="70"></el-table-column>
				<el-table-column label="登录名" prop="name"></el-table-column>
				<el-table-column label="头像" prop="id" width="80">
					<template #default="scope">
						<el-popover>
							<template #reference>
								<el-avatar :src="scope.row.avatar" size="small"/>
							</template>
							<template #default>
								<el-image style="width: 100%; height: 100%" :src="scope.row.avatar"/>
							</template>
						</el-popover>
					</template>
				</el-table-column>
				<el-table-column label="真实姓名" prop="real_name"></el-table-column>
				<el-table-column label="超级管理员" prop="is_admin">
					<template #default="scope">
						<el-tag v-if="scope.row.is_admin==10" type="success">是</el-tag>
						<el-tag v-if="scope.row.is_admin==99" type="danger">否</el-tag>
					</template>
				</el-table-column>
				<el-table-column label="性别" prop="sex">
					<template #default="scope">
						<el-tag v-if="scope.row.sex==10" type="info">保密</el-tag>
						<el-tag v-if="scope.row.sex==20" type="success">男</el-tag>
						<el-tag v-if="scope.row.sex==30" type="danger">女</el-tag>
					</template>
				</el-table-column>
				<el-table-column label="登录状态" prop="status">
					<template #default="scope">
						<el-tag v-if="scope.row.status==10" type="success">启用</el-tag>
						<el-tag v-if="scope.row.status==20" type="danger">停用</el-tag>
					</template>
				</el-table-column>
				<el-table-column label="手机号码" prop="mobile"></el-table-column>
				<el-table-column label="email" prop="email"></el-table-column>
				<el-table-column label="登录IP" prop="login_ip"></el-table-column>
				<el-table-column label="排序" prop="sort"></el-table-column>
				<el-table-column label="创建时间" prop="create_at" width="150"></el-table-column>
				<el-table-column label="操作" fixed="right" align="center" width="250">
					<template #default="scope">
						<el-button-group>
							<el-button text type="primary" size="small" @click="edit(scope.row, scope.$index)">
								编辑
							</el-button>
							<el-button text type="primary" size="small" @click="group(scope.row, scope.$index)">
								编辑角色
							</el-button>
							<el-popconfirm title="确定删除吗？" @confirm="del(scope.row, scope.$index)">
								<template #reference>
									<el-button text type="danger" size="small">删除</el-button>
								</template>
							</el-popconfirm>
						</el-button-group>
					</template>
				</el-table-column>
			</scTable>
		</el-main>
	</el-container>

	<add-dialog v-if="dialog.add" ref="addDialog" @success="handleSaveSuccess"
				@closed="dialog.add=false"></add-dialog>

	<save-dialog v-if="dialog.save" ref="saveDialog" @success="handleSaveSuccess"
				 @closed="dialog.save=false"></save-dialog>

	<group-dialog v-if="dialog.group" ref="groupDialog" @success="handleSaveSuccess"
				  @closed="dialog.group=false"></group-dialog>

</template>

<script>

import addDialog from './add'
import saveDialog from './save'
import groupDialog from './group'

export default {
	name: 'admin',
	components: {
		addDialog,
		saveDialog,
		groupDialog
	},
	data() {
		return {
			dialog: {
				add: false,
				save: false,
				group: false
			},
			apiObj: this.$API.system.admin.list,
			selection: [],
			search: {}
		}
	},
	methods: {
		//添加
		add() {
			this.dialog.add = true
			this.$nextTick(() => {
				this.$refs.addDialog.open()
			})
		},
		//编辑
		edit(row) {
			this.dialog.save = true
			this.$nextTick(() => {
				this.$refs.saveDialog.open().setData(row)
			})
		},
		//权限组设置
		group(row) {
			this.dialog.group = true
			this.$nextTick(() => {
				this.$refs.groupDialog.open(row)
			})
		},
		//删除
		async del(row) {
			var reqData = {id: row.id}
			var res = await this.$API.system.admin.delete.post(reqData)

			if (res.code == 200) {
				this.$refs.table.refresh()
				this.$message.success("删除成功")
			} else {
				this.$alert(res.msg, "提示", {type: 'error'})
			}
		},
		//搜索
		upsearch() {
			this.$refs.table.upData(this.search)
		},
		//本地更新数据
		handleSaveSuccess() {
			this.$refs.table.refresh()
		}
	}
}
</script>

<style>
</style>
