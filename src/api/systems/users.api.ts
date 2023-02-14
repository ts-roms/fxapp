import { httpApi } from '../http.api';
import { BasicTableData, Pagination } from '../table.api';

export const getUsers = (
    pagination: Pagination,
    pageSize: number
): Promise<BasicTableData> => httpApi.get('api/v1/admin/user/list').then(({data}) => data).catch(e => e)