import React from 'react';
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';

// no lazy loading for auth pages to avoid flickering
const AuthLayout = React.lazy(
  () => import('@app/components/layouts/AuthLayout/AuthLayout'),
);
import LoginPage from '@app/pages/LoginPage';
import ForgotPasswordPage from '@app/pages/ForgotPasswordPage';
import SecurityCodePage from '@app/pages/SecurityCodePage';
import NewPasswordPage from '@app/pages/NewPasswordPage';
import LockPage from '@app/pages/LockPage';

import MainLayout from '@app/components/layouts/main/MainLayout/MainLayout';
import ProfileLayout from '@app/components/profile/ProfileLayout';

import RequireAuth from '@app/routes/router/RequireAuth';
import { withLoading } from '@app/hocs/withLoading.hoc';
import DashboardPage from '@app/pages/DashboardPages/DashboardPage';
import TransactionPage from '@app/pages/TransactionPage';
import CollectionPage from '@app/pages/CollectionPage';

const NewsFeedPage = React.lazy(() => import('@app/pages/NewsFeedPage'));
const KanbanPage = React.lazy(() => import('@app/pages/KanbanPage'));
const EmployeePage = React.lazy(() => import('@app/pages/EmployeePage'));
const PersonalInfoPage = React.lazy(
  () => import('@app/pages/PersonalInfoPage'),
);
const Logout = React.lazy(() => import('./Logout'));

const ServerErrorPage = React.lazy(() => import('@app/pages/ServerErrorPage'));
const Error404Page = React.lazy(() => import('@app/pages/Error404Page'));

// System Configuration
const BranchesPage = React.lazy(() => import('@app/pages/BranchesPage'));
const UsersPage = React.lazy(() => import('@app/pages/UsersPage'));

const LoanConfigPage = React.lazy(() => import('@app/pages/LoanConfigPage'));
const LoanFormPage = React.lazy(() => import('@app/pages/LoanFormPage'));
const ChartsOfAccountPage = React.lazy(() => import('@app/pages/ChartsOfAccountPage'));

export const DASHBOARD_PATH = '/';

const Dashboard = withLoading(DashboardPage);
const PersonalInfo = withLoading(PersonalInfoPage);
const NewsFeed = withLoading(NewsFeedPage);
const Kanban = withLoading(KanbanPage);

const Transactions = withLoading(TransactionPage);
const Collections = withLoading(CollectionPage);

const ServerError = withLoading(ServerErrorPage);
const Error404 = withLoading(Error404Page);

// System Configuration
const Employee = withLoading(EmployeePage);
const Branches = withLoading(BranchesPage);
const Users = withLoading(UsersPage);
const LoanConfig = withLoading(LoanConfigPage);
const LoanForm = withLoading(LoanFormPage);
const ChartOfAccount = withLoading(ChartsOfAccountPage);

const AuthLayoutFallback = withLoading(AuthLayout);
const LogoutFallback = withLoading(Logout);

export const AppRouter: React.FC = () => {
  const protectedLayout = (
    <RequireAuth>
      <MainLayout />
    </RequireAuth>
  );

  return (
    <BrowserRouter>
      <Routes>
        <Route path={DASHBOARD_PATH} element={protectedLayout}>
          <Route index path={DASHBOARD_PATH} element={<Dashboard />} />
          <Route path="transactions" element={<Transactions />} />
          <Route path="collections" element={<Collections />} />
          <Route path="funds" element={<Transactions />} />
          <Route path="expenses" element={<Transactions />} />
          <Route path="other-income" element={<Transactions />} />
          <Route path="big-brother" element={<Transactions />} />
          <Route path="reports" element={<Transactions />} />

          <Route path="application">
            <Route path="employees" element={<Employee />} />
            <Route path="feed" element={<NewsFeed />} />
            <Route path="kanban" element={<Kanban />} />
            <Route path="expenses" element={<Kanban />} />
            <Route path="other-income" element={<Kanban />} />
            <Route path="custom-fields" element={<Kanban />} />
          </Route>
          <Route path="configuration">
            <Route path="loan" element={<LoanConfig />} />
            <Route path="loan-form" element={<LoanForm />} />

            <Route path="accounting">
              <Route path="chart-of-account" element={<ChartOfAccount />} />
            </Route>
          </Route>
          <Route path="profile" element={<ProfileLayout />}>
            <Route path="personal-info" element={<PersonalInfo />} />
          </Route>
          <Route path="system">
            <Route path="users" element={<Users />} />
            <Route path="branches" element={<Branches />} />
          </Route>
          <Route path="audit-trail" element={<Transactions />} />
        </Route>

        <Route path="/auth" element={<AuthLayoutFallback />}>
          <Route path="login" element={<LoginPage />} />
          <Route
            path="lock"
            element={
              <RequireAuth>
                <LockPage />
              </RequireAuth>
            }
          />
          <Route path="forgot-password" element={<ForgotPasswordPage />} />
          <Route path="security-code" element={<SecurityCodePage />} />
          <Route path="new-password" element={<NewPasswordPage />} />
        </Route>
        <Route path="/logout" element={<LogoutFallback />} />
        <Route path="404" element={<Error404 />} />
        <Route path="server-error" element={<ServerError />} />
        <Route path="*" element={<Navigate to="/404" />} />
      </Routes>
    </BrowserRouter>
  );
};
