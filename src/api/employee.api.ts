import { httpApi } from "./http.api"
import { BasicTableData, Pagination } from "./table.api";


export const getEmployees = (
  pagination: Pagination,
  pageSize: number
): Promise<BasicTableData> => {
  return httpApi.get('api/v1/employee/list')
    .then(({ data }) => data)
    .catch((e) => e);
}

export const create = (payload: any): Promise<any> => {
  return httpApi.post('api/v1/employee/create', { ...payload })
  .then(({ data }) => data)
  .catch((e) => e);
}