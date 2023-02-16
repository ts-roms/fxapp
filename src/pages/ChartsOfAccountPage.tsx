import React from 'react';
import { useTranslation } from 'react-i18next';
import { PageTitle } from '@app/components/common/PageTitle/PageTitle';
import { ChartsOfAccount } from '@app/components/apps/configuration/accounting/charts-of-account/ChartsOfAccount';

const ChartsOfAccountPage: React.FC = () => {
  const { t } = useTranslation();

  return (
    <>
      <PageTitle>{t('common.loanForm')}</PageTitle>
      <ChartsOfAccount />
    </>
  );
};

export default ChartsOfAccountPage;
