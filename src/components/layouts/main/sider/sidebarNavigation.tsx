import React from 'react';
import {
  DashboardOutlined,
  UserSwitchOutlined,
  TransactionOutlined,
  FileSyncOutlined,
  FundOutlined,
  MoneyCollectOutlined,
  RiseOutlined,
  UserOutlined,
  AuditOutlined,
} from '@ant-design/icons';

export interface SidebarNavigationItem {
  title: string;
  key?: string;
  url?: string;
  children?: SidebarNavigationItem[];
  icon?: React.ReactNode;
  isDisabled?: true;
}

export const sidebarNavigation: SidebarNavigationItem[] = [
  {
    title: 'common.medical-dashboard',
    key: 'medical-dashboard',
    url: '/',
    icon: <DashboardOutlined />,
  },
  {
    title: 'common.transactions',
    key: 'transactions',
    url: '/transactions',
    icon: <TransactionOutlined />,
  },
  {
    title: 'Collections',
    key: 'collections',
    url: '/collections',
    icon: <FileSyncOutlined />,
  },
  {
    title: 'Funds',
    key: 'funds',
    url: '/funds',
    icon: <FundOutlined />,
  },
  {
    title: 'Expenses',
    key: 'expenses',
    url: '/expenses',
    icon: <MoneyCollectOutlined />,
  },
  {
    title: 'Other Income',
    key: 'other-income',
    url: '/other-income',
    icon: <RiseOutlined />,
  },
  {
    title: 'Big Brother',
    key: 'big-brother',
    url: '/big-brother',
    icon: <UserOutlined />,
  },
  {
    title: 'Reports',
    key: 'reports',
    url: '/reports',
    icon: <AuditOutlined />,
  },
  {
    title: 'Configurations',
    key: 'configuration',
  },
  {
    title: 'Application',
    key: 'application-config',
    icon: <UserSwitchOutlined />,
    children: [
      {
        title: 'Employees',
        key: 'application-employees',
        url: 'application/employees',
      },
      {
        title: 'Expenses',
        key: 'application-expenses',
        url: 'application/expenses',
      },
      {
        title: 'Other Income',
        key: 'application-other-income',
        url: 'application/other-income',
      },
      {
        title: 'Custom Fields',
        key: 'application-custom-fields',
        url: 'application/custom-fields',
      },
    ],
  },
  {
    title: 'Loan',
    key: 'configuration-loan',
    icon: <AuditOutlined />,
    children: [
      {
        title: 'Loans',
        key: 'accounting-report',
        url: '/configuration/loan',
      },
    ],
  },
  {
    title: 'Accounting',
    key: 'configuration-accounting',
    icon: <AuditOutlined />,
    children: [
      {
        title: 'common.kanban',
        key: 'accounting-charts',
        url: '/configuration/kanban',
      },
    ],
  },
  {
    title: 'System',
    key: 'system-configuration',
    icon: <AuditOutlined />,
    children: [
      {
        title: 'Users',
        key: 'users-system-configuration',
        url: '/system/users',
      },
      {
        title: 'Branches',
        key: 'branches-system-configuration',
        url: '/system/branches',
      },
    ],
  },
  {
    title: 'Audit Trail',
    key: 'audit-trail',
    url: '/audit-trail',
    icon: <AuditOutlined />,
  },
];
