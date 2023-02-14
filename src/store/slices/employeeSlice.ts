import { create, CreateEmployeeRequest } from '@app/api/employee.api';
import { IEmployeeModel } from '@app/domain/EmployeeModel';
import { createAsyncThunk, createSlice } from '@reduxjs/toolkit';

export interface IEmployeeState {
  employee: IEmployeeModel | undefined;
}

const initialState: IEmployeeState = {
  employee: undefined,
};

export const doCreate = createAsyncThunk(
  'employee/doCreate',
  async (createPayload: CreateEmployeeRequest) => create(createPayload),
);

const employeeSlice = createSlice({
  name: 'employee',
  initialState,
  reducers: {},
  extraReducers: (builder) => {
    builder.addCase(doCreate.fulfilled, (state, action) => {
      state.employee = action.payload;
    });
  },
});

export default employeeSlice.reducer;
