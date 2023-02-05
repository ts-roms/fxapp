import { useState } from 'react';
import { PlusOutlined } from '@ant-design/icons';
import { Button } from '@app/components/common/buttons/Button/Button';
import BranchesModal from '@app/components/modals/modal/BranchesModal';
import { BranchesTable } from '@app/components/tables/Branches/BranchesTable';
import { useTranslation } from 'react-i18next';
import * as S from './Branches.styles';

export const Branches: React.FC = () => {
  const { t } = useTranslation();
  const [open, setOpen] = useState(false);
  return (
    <S.MainWrapper>
      <BranchesModal open={open} setOpen={setOpen} />
      <S.Card
        id={'branches-table'}
        title={t('tables.title', { name: 'Branches' })}
        padding="1.25rem 1.25rem 0"
        extra={
          <S.ActionWrapper>
            <Button
              type={'ghost'}
              icon={<PlusOutlined />}
              onClick={() => setOpen((open) => !open)}
            >
              {t('actions.new', { name: 'Branch' })}
            </Button>
          </S.ActionWrapper>
        }
      >
        <BranchesTable />
      </S.Card>
    </S.MainWrapper>
  );
};
